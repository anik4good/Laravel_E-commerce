<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('author.profile.index');
    }

    public function updateprofile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $image = $request->file('image');
        $slug = str::slug($request->name);
        $user = User::findOrFail(Auth::user()->id);
        //checking image if uploaded
        if (isset($image)) {

            $datetime = Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug . '-' . $datetime . '-' . Str::random(10) . '.' . $ext;

            //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
//                checking if images is already  there then delete
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }

            // image resize
            $proimage = Image::make($image)->resize(300, 200)->stream();
            Storage::disk('public')->put('profile/' . $imgname, $proimage);

        } else {
            // put default image if no image select
            $imgname = $user->image;

        }

        //now saving all to database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imgname;
        $user->about = $request->about;
        $user->update();
        Toastr::success('Profile Data Successfully Updated');
        return redirect()->back();

    }


    public function updatepassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hash_old_pass = Auth::user()->password;
        if(Hash::check($request->old_password,$hash_old_pass)) //checking if old pass from database and form is match
        {
            if(!Hash::check($request->password,$hash_old_pass))//checking if old pass from database and new pass from form is not same
            {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Updated');
                Auth::logout();
                return redirect()->back();

            }
            else
            {
                Toastr::error('New Password cannot be same as old password');
                return redirect()->back();
            }
        }

        else
        {
            Toastr::error('Current Password not Match');
            return redirect()->back();
        }

    }
}
