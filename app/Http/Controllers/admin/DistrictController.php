<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use DB;

class DistrictController extends Controller
{
    public function index()
    {
        $Users = District::OrderBy('id', 'desc')->with('City')->paginate(10);
        return view('Admin.District.index', compact('Users'));

    }


    public function store(Request $request)
    {

        $this->validate(request(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        $User = new District();
        $User->ar_title = $request->name_ar;
        $User->en_title = $request->name_en;
        $User->city_id = $request->city_id;


        try {
            $User->save();

        } catch (Exception $e) {
            return back()->with('error_message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }

    public function delete(Request $request)
    {
        try {
            District::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }


    public function edit(Request $request)
    {
        $User = District::find($request->id);

        return view('Admin.District.model', compact('User'));
    }


    public function update(Request $request)
    {

        $this->validate(request(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',

        ]);

        $User = District::find($request->id);
        $User->ar_title = $request->name_ar;
        $User->en_title = $request->name_en;
        $User->city_id = $request->city_id;

        try {

            $User->save();

        } catch (\Exception $e) {
            return back()->with('message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }
    public function GetDistricts($id){
        $data = District::where('city_id',$id)->pluck('id','ar_title');

        return response($data);
    }

    public function GetDistricts2($id){
        $data = District::where('city_id',$id)->get();

        return response($data);
    }

}
