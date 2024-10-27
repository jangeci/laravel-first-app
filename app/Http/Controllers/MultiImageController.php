<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MultiImageController extends Controller
{
    public function Multipic()
    {
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImg(Request $request)
    {
        $request->validate([
            'images.*' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'image.required' => 'Please choose image',
            ]
        );

        $images = $request->file('images');
        $manager = new ImageManager(new Driver());

        foreach ($images as $singleImage) {
            $name_gen = hexdec(uniqid()) . '.' . strToLower($singleImage->getClientOriginalExtension());
            $up_location = 'image/multi/';
            $last_img = $up_location . $name_gen;
            $resizedImage = $manager->read($singleImage)->resize(200, height: 200)->save($last_img);

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('success', 'Images added successfully');
    }
}
