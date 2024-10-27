<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeAboutController extends Controller
{
    public function HomeAbout()
    {
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeAbout'));
    }

    public function AddAbout()
    {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'About Inserted Successfully');
    }

    public function EditAbout($id)
    {
        $homeAbout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeAbout'));
    }

    public function UpdateAbout(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        return Redirect()->route('home.about')->with('success', 'About Updated Successfully');
    }

    public function DeleteAbout($id)
    {
        HomeAbout::find($id)->delete();
        return Redirect()->route('home.about')->with('success', 'About Deleted Successfully');
    }
}
