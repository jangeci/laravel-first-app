<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Routing\Controller;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Please enter brand name',
                'brand_name.min' => 'Brand name must be at least 4 characters',
                'brand_image.required' => 'Please choose brand image',
            ]
        );

//        $brand_image = $request->file('brand_image');
//        $name_gen = hexdec(uniqid());
//        $img_ext = strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen . '.' . $img_ext;
//        $up_location = 'image/brand/';
//        $last_img = $up_location . $img_name;
//        $brand_image->move($up_location, $img_name);


        $manager = new ImageManager(new Driver());
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . strToLower($brand_image->getClientOriginalExtension());
        $up_location = 'image/brand/';
        $image = $manager->read($brand_image)->resize(width: 200, height: 200)->save($up_location . $name_gen);
        $last_img = $up_location . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand created successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|min:4',
        ],
            [
                'brand_name.required' => 'Please enter brand name',
                'brand_name.min' => 'Brand name must be at least 4 characters',
            ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if ($brand_image) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . strToLower($brand_image->getClientOriginalExtension());
            $up_location = 'image/brand/';
            $brand_image = $request->file('brand_image');
            $image = $manager->read($brand_image)->resize(200, height: 200)->save($up_location . $name_gen);
            $last_img = $up_location . $name_gen;

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand updated successfully');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand name successfully');
        }
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();

        return Redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
