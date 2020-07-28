<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tittle' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',

        ]);

        $image = $request->file('image');
        $slug = str::slug($request->tittle);

        //checking image if uploaded
        if (isset($image)) {
            $datetime= Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug.'-'.$datetime.'-'.Str::random(10).'.'.$ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            // image resize
            $proimage =  Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('post/'.$imgname,$proimage );

            //            For Slider
        }
        else
        {
//             put default image if no image select
            $imgname = 'default.png';
        }

        //now saving all to database
        $post = new Post();
        $post->tittle = $request->tittle;
        $post->slug = $slug;
        $post->user_id = Auth::id();
        $post->image = $imgname;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = 1;
        }
        else
        {
            $post->status = 0;
        }

        $post->is_approved = 0;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        Toastr::success('Post Data Successfully Updated');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('No Permission ');
            return redirect()->back();
        }
        return view('author.post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('No Permission ');
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('No Permission ');
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'tittle' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',

        ]);

        $image = $request->file('image');
        $slug = str::slug($request->tittle);

        //checking image if uploaded
        if (isset($image)) {
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            //            //checking if images is already  there then delete
            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
            // image resize
            $proimage = Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('post/' . $imgname, $proimage);

            //            For Slider
        } else {
//             put default image if no image select
            $imgname = $post->image;
        }

        //now saving all to database

        $post->tittle = $request->tittle;
        $post->slug = $slug;
        $post->user_id = Auth::id();
        $post->image = $imgname;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = 1;
        } else {
            $post->status = 0;
        }
        $post->is_approved = 0;
        $post->update();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success('Post Data Updated ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('No Permission ');
            return redirect()->back();
        }
        //            //checking if images is already  there then delete
        if (Storage::disk('public')->exists('category/' . $post->images)) {
            Storage::disk('public')->delete('category/' . $post->images);
        }
        $post->delete();
        Toastr::error('Post Data deleted ');
        return redirect()->back();
    }
}
