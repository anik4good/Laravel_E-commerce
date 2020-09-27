<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brand = brand::latest()->get();
        return view('admin.brand.index',compact('brand'));
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
            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }
        // image resize
           $proimage =  Image::make($image)->resize(300, 200)->stream();
           Storage::disk('public')->put('brand/'.$imgname,$proimage );

            //            For Slider
      }
        else
        {
//             put default image if no image select
            $imgname = 'default.png';
        }

        //now saving all to database
        $brand =  new Brand();
        $brand->name = $request->name;
        $brand->image = $imgname;
        $brand->slug = $slug;
        $brand->save();
        Toastr::success('Data Successfully Added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $brand_all = Brand::latest()->get();

        return view('admin.brand.edit',compact('brand_all','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
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
            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }

                    //            //checking if images is already  there then delete
        if (Storage::disk('public')->exists('brand/'.$brand->image)) {
            Storage::disk('public')->delete('brand/'.$brand->image);
        }


        // image resize
           $proimage =  Image::make($image)->resize(300, 200)->stream();
           Storage::disk('public')->put('brand/'.$imgname,$proimage );

            //            For Slider
      }
        else
        {
//             put default image if no image select
            $imgname = $brand->image;
        }

        //now saving all to database
        $brand->name = $request->name;
        $brand->image = $imgname;
        $brand->slug = $slug;
        $brand->update();
        Toastr::success('Data Successfully updated');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {


        //            //checking if images is already  there then delete
        if (Storage::disk('public')->exists('brand/'.$brand->image)) {
            Storage::disk('public')->delete('brand/'.$brand->image);
        }
        $brand->delete();
        Toastr::error(' Data Successfully Deleted');
        return redirect()->back();
    }



    public function status($id)
    {
        $post = Brand::find($id);
        if ($post->status == 0) {
            $post->status = 1;
            $post->update();
            Toastr::error('Active! ');
            return redirect()->back();
        }
        elseif($post->status ==1 )
        {
            $post->status = 0;
            $post->update();
            Toastr::error('Disable!');
            return redirect()->back();
        }


        else {
            Toastr::error('Already Active!');
            return redirect()->back();
        }
    }
}
