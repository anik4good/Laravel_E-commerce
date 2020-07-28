<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {


        $category = Category::latest()->get();
        return view('admin.category.index',compact('category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required',
        ]);

        $image = $request->file('image');
        $slug = str::slug($request->name);

        //checking image if uploaded
 if (isset($image)) {
            $datetime= Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug.'-'.$datetime.'-'.Str::random(10).'.'.$ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
        // image resize
           $proimage =  Image::make($image)->resize(300, 200)->stream();
           Storage::disk('public')->put('category/'.$imgname,$proimage );

            //            For Slider
      }
        else
        {
//             put default image if no image select
            $imgname = 'default.png';
        }

        //now saving all to database
        $category =  new Category();
        $category->name = $request->name;
        $category->images = $imgname;
        $category->slug = $slug;
        $category->save();
        Toastr::success('Profile Data Successfully Updated');
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_all = Category::latest()->get();
        $category_single = Category::find($id);
        return view('admin.category.edit',compact('category_all','category_single'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',

        ]);
        $image = $request->file('image');
        $slug = str::slug($request->name);
        $category= Category::findOrFail($id);

        //checking image if uploaded
        if (isset($image)) {
            $datetime= Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug.'-'.$datetime.'-'.Str::random(10).'.'.$ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

//            //checking if images is already  there then delete
            if (Storage::disk('public')->exists('category/'.$category->images)) {
                Storage::disk('public')->delete('category/'.$category->images);
            }

            // image resize
            $proimage =  Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('category/'.$imgname,$proimage );

            //            For Slider

        }
        else
        {
//             put default image if no image select
            $imgname = $category->images;
        }

        //now saving all to database
        $category->name = $request->name;
        $category->images = $imgname;
        $category->slug = $slug;
        $category->update();
        Toastr::success('Profile Data Successfully Updated');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_single = Category::findOrFail($id);

        //            //checking if images is already  there then delete
        if (Storage::disk('public')->exists('category/'.$category_single->images)) {
            Storage::disk('public')->delete('category/'.$category_single->images);
        }
        $category_single->delete();
        Toastr::success(' Data Successfully Deleted');
        return redirect()->back();

    }
}
