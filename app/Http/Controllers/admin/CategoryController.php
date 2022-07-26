<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $Users = MainCategory::OrderBy('id', 'desc')->get();
        return view('Admin.MainCategory.index', compact('Users'));

    }


    public function Search(Request $request)
    {
        $query = DB::table('main_categories')->OrderBy('id', 'desc');
        if ($request->name != null) {
            $query->where('ar_title','like','%'.$request->name.'%')->orWhere('en_title','like','%'.$request->name.'%');
        }

        $Users = $query->get();
        return view('Admin.MainCategory.index', compact('Users'));

    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'ar_title' => 'required|string',
            'en_title' => 'required|string',
            'image' => 'required',
            'is_visible' => 'required',

        ]);

        $User=new MainCategory;
        $User->ar_title=$request->ar_title;
        $User->en_title=$request->en_title;
            $User->is_visible=$request->is_visible;
        if($request->file('image')){
            $User->image=$request->image;

        }
         try {
            $User->save();
        } catch (\Exception $e) {
            return back()->with('error_message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }

    public function delete(Request $request)
    {
        try {
            MainCategory::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }


    public function edit(Request $request)
    {
        $User = MainCategory::find($request->id);
        return view('Admin.MainCategory.model', compact('User'));
    }


    public function update(Request $request)
    {

        $this->validate(request(), [
            'ar_title' => 'required|string',
            'en_title' => 'required|string',
        ]);




        $User= MainCategory::find($request->id);
        $User->ar_title=$request->ar_title;
        $User->en_title=$request->en_title;
        $User->is_visible=$request->is_visible;
        if($request->file('image')){
            $User->image=$request->image;

         }
        $User->save();


        try {

        } catch (\Exception $e) {
            return back()->with('message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }
    public function GetSubCategory($id){
        $data = SubCategory::where('main_category_id',$id)->pluck('id','ar_title');

        return response($data);
    }

    public function GetSubCategory2($id){
        $data = SubCategory::where('main_category_id',$id)->get();

        return response($data);
    }

}
