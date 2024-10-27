<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function AllCat()
    {
//        $categories = DB::table('categories')->join('users', 'categories.user_id', '=', 'users.id')->select('categories.*', 'users.name')->latest()->paginate(5);
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
//        $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function Add(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
            [
                'category_name.required' => 'Please input Category Name',
                'category_name.unique' => 'Category Name Already Exist',
                'category_name.max' => 'Category Name Must Be Less Than 255 Characters',
            ],
        );

//        Category::insert(['category_name' => $request->category_name,
//            'user_id' => Auth::user()->id,
//            'created_at'=> Carbon::now()
//            ]);

//        $category = new Category;
//        $category->category_name = $request->input('category_name');
//        $category->user_id = Auth::user()->id;
//        $category->created_at = Carbon::now();
//        $category->save();

        $data = array();
        $data['category_name'] = $request->input('category_name');
        $data['user_id'] = Auth::id();
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }

    public function Edit($id)
    {
//        $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

//        $update = Category::find($id)->update([
//            'category_name' => $request->input('category_name'),
//            'user_id' => Auth::id(),
//        ]);

        $data = array();
        $data['category_name'] = $request->input('category_name');
        $data['user_id'] = Auth::id();
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('category.all')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();

        return Redirect()->route('category.all')->with('success', 'Category Soft Delete Success');
    }

    public function Restore($id)
    {
        $restore = Category::withTrashed($id)->restore();

        return Redirect()->route('category.all')->with('success', 'Category Restored Successfully');
    }

    public function PDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->route('category.all')->with('success', 'Category Permanently Deleted');
    }
}
