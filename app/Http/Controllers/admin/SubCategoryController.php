<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    public function index($id)
    {
        $Users = SubCategory::where('main_category_id', $id)->OrderBy('id', 'desc')->get();
        return view('Admin.SubCategory.index', compact('Users', 'id'));
    }

    public function Search(Request $request)
    {
        $query = DB::table('sub_categories')->OrderBy('id', 'desc')->where('main_category_id', $request->main_category_iddd);
        if ($request->name != null) {
            $query->where('ar_title', 'like', '%' . $request->name . '%')->orWhere('en_title', 'like', '%' . $request->name . '%');
        }

        $Users = $query->get();
        $id = $request->main_category_id;
        return view('Admin.SubCategory.index', compact('Users', 'id'));

    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'main_category_id' => 'required|string',

        ]);

        foreach (MainCategory::all() as $mainCategory) {
            $User = new SubCategory;
            $User->ar_title = $request->name_ar;
            $User->en_title = $request->name_en;
            $User->is_visible = $request->is_visible;
            $User->main_category_id = $mainCategory->id;

            if ($request->file('icon')) {
                $User->icon = $request->icon;
            }
            if ($request->file('image')) {
                $User->image = $request->image;

            }
            try {
                $User->save();
            } catch (Exception $e) {
//                return back()->with('error_message', 'Failed');
            }
        }
        return redirect()->back()->with('message', 'Success');
    }

    public function delete(Request $request)
    {
        try {
            SubCategory::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }


    public function edit(Request $request)
    {
        $User = SubCategory::find($request->id);
        return view('Admin.SubCategory.model', compact('User'));
    }


    public function update(Request $request)
    {

        $this->validate(request(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);


        $User = SubCategory::find($request->id);
        $User->ar_title = $request->name_ar;
        $User->en_title = $request->name_en;
        $User->is_visible = $request->is_visible;

        if ($request->file('image')) {
            $User->image = $request->image;

        }
        $User->save();


        try {

        } catch (\Exception $e) {
            return back()->with('message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }
}
