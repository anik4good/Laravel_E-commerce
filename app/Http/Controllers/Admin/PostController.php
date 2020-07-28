<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\AuthorPostApproval;
use App\Notifications\NewPostNotify;
use App\Post;
use App\Subscriber;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $post = Post::latest()->get();
        return view('admin.post.index', compact('post'));

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
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Request
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
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            // image resize
            $proimage = Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('post/' . $imgname, $proimage);

            //            For Slider
        } else {
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
        if (isset($request->status)) {
            $post->status = 1;
        } else {
            $post->status = 0;
        }

        $post->is_approved = 1;


        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $subs = Subscriber::all();

        foreach ($subs as $sub)
        {
            Notification::route('mail',$sub->email)->notify(new NewPostNotify($post));
        }


        Toastr::success('Post Data Successfully Updated');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
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
        $post->is_approved = 1;
        $post->update();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success('Post Data Updated ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //            //checking if images is already  there then delete
        if (Storage::disk('public')->exists('category/' . $post->images)) {
            Storage::disk('public')->delete('category/' . $post->images);
        }
        $post->delete();
        Toastr::error('Post Data deleted ');
        return redirect()->back();
    }

    public function pending()
    {

        $pendingpost = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('pendingpost'));
    }

    public function approve($id)
    {

        $post = Post::find($id);
        if ($post->is_approved == 0) {
            $post->is_approved = 1;
            $post->update();
            $post->user->notify(new AuthorPostApproval($post));
            $subs = Subscriber::all();
            foreach ($subs as $sub)
            {
                Notification::route('mail',$sub->email)->notify(new NewPostNotify($post));
            }
            Toastr::error('Post Approved! ');
            return redirect()->back();
        } else {
            Toastr::error('Post Already Approved! ');
            return redirect()->back();
        }
    }
}
