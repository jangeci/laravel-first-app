<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $slides = Slider::latest()->get();
        return view('admin.slider.index', compact('slides'));
    }

    public function AddSlide()
    {
        return view('admin.slider.create');
    }

    public function StoreSlide(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ],
            [
                'title.required' => 'Please enter title',
                'description.required' => 'Please enter description',
                'image.required' => 'Please choose image',
                'image.mimes' => 'Please choose valid image',
            ]
        );

        $manager = new ImageManager(new Driver());
        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . strToLower($slider_image->getClientOriginalExtension());
        $up_location = 'image/home_slider/';
        $last_img = $up_location . $name_gen;
        $manager->read($slider_image)->cover(1920, 1088, 'center')->save($last_img);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slide Added Successfully');
    }

    public function EditSlide($id)
    {
        $slide = DB::table('sliders')->where('id', $id)->first();
        return view('admin.slider.edit', compact('slide'));
    }

    public function UpdateSlide(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ],
            [
                'title.required' => 'Please enter title',
                'description.required' => 'Please enter description',
                'image.required' => 'Please choose image',
                'image.mimes' => 'Please choose valid image',
            ]
        );

        $old_image = $request->old_image;
        $slider_image = $request->file('image');
        if ($slider_image) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . strToLower($slider_image->getClientOriginalExtension());
            $up_location = 'image/home_slider/';
            $last_img = $up_location . $name_gen;
            $manager->read($slider_image)->cover(1920, 1088, 'center')->save($last_img);

            unlink($old_image);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
            ]);
        } else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }


        return Redirect()->route('home.slider')->with('success', 'Slide Updated Successfully');
    }

    public function DeleteSLide($id)
    {
        $slide = Slider::find($id);
        unlink($slide->image);

        Slider::find($id)->delete();

        return Redirect()->back()->with('success', 'Slide Deleted Successfully');
    }
}
