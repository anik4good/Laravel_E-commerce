<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
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


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::latest()->get();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
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
            'image1' => 'mimes:jpeg,jpg,png,gif|required',
            'image2' => 'mimes:jpeg,jpg,png,gif|required',
            'image3' => 'mimes:jpeg,jpg,png,gif|required',
            'categories' => 'required',
            'long_description' => 'required',

        ]);

        $image = $request->file('image');
        $image1 = $request->file('image1');
        $image2 = $request->file('image2');
        $image3 = $request->file('image3');
        $slug = str::slug($request->tittle);
        //checking image if uploaded
        if (isset($image)) {
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }
            // image resize
            $proimage = Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('product/' . $imgname, $proimage);

            //            For Slider
        }

        //checking image if uploaded
        if (isset($image1)) {
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image1->getClientOriginalExtension());
            $imgname1 = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }
            // image resize
            $proimage1 = Image::make($image1)->resize(300, 200)->stream();
            Storage::disk('public')->put('product/' . $imgname1, $proimage1);

            //            For Slider
        }
        //checking image if uploaded
        if (isset($image2)) {
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image2->getClientOriginalExtension());
            $imgname2 = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }
            // image resize
            $proimage2 = Image::make($image2)->resize(300, 200)->stream();
            Storage::disk('public')->put('product/' . $imgname2, $proimage2);

            //            For Slider
        }

        //checking image if uploaded
        if (isset($image3)) {
            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image3->getClientOriginalExtension());
            $imgname3 = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

//            For category
            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }
            // image resize
            $proimage3 = Image::make($image3)->resize(300, 200)->stream();
            Storage::disk('public')->put('product/' . $imgname3, $proimage3);

            //            For Slider
        }

        else {
//             put default image if no image select
            $imgname = 'default.png';
        }

        //now saving all to database
        $product = new Product();
        $product->product_tittle = $request->tittle;
        $product->product_slug = $slug;
        $product->user_id = Auth::id();
        $product->product_price = $request->price;
        $product->product_image = $imgname;
        $product->gallary_image_1 = $imgname1;
        $product->gallary_image_2 = $imgname2;
        $product->gallary_image_3 = $imgname3;
        $product->long_description = $request->long_description;
        $product->short_description = $request->short_description;
        $product->product_code = Str::random(4);
        if (isset($request->status)) {
            $product->product_status = 1;
        } else {
            $product->product_status = 0;
        }

        $product->product_is_approved = 1;
        $product->save();
        $product->categories()->attach($request->categories);
        $product->brands()->attach($request->brands);
        Toastr::success('Post Data Successfully Updated');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function status($id)
    {
        $post = Product::find($id);
        if ($post->status == 0) {
            $post->status = 1;
            $post->update();
            Toastr::error('Post Active! ');
            return redirect()->back();
        }
        elseif($post->status ==1 )
        {
            $post->status = 0;
            $post->update();
            Toastr::error('Post Disable!');
            return redirect()->back();
        }


        else {
            Toastr::error('Post Already Approved!');
            return redirect()->back();
        }
    }


    public function pending($id)
    {

    }

    public function approve($id)
    {
    }

}
