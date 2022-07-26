<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{


    public function index()
    {

        $Users = Owner::OrderBy('id', 'desc')->get();
        return view('Admin.Owner.index', compact('Users'));

    }


    public function Search(Request $request)
    {
        $query = DB::table('owners')->OrderBy('id', 'desc');
        if ($request->name != null) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->phone != null) {
            $query->where('phone', $request->phone);
        }
        $Users = $query->get();
        return view('Admin.Owner.index', compact('Users'));

    }



    public function view($id)
    {
        $User = Owner::find($id);
        return view('Admin.Owner.view', compact('User'));

    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'string|email|unique:owners',
            'phone' => 'required|string|unique:owners',
            'image' => 'nullable|image',
            'id_num' => 'required|string|unique:owners',

        ]);

        $User = new Owner;
        $User->name = $request->name;
        $User->phone = $request->phone;
        $User->email = $request->email;
        $User->id_num = $request->id_num;
        $User->id_num_expired = $request->id_num_expired;
        $User->id_num_export = $request->id_num_export;
        $User->district = $request->district;
        $User->nationality = $request->nationality;
        $User->tax_num = $request->tax_num;

        if ($request->file('image')) {
            $User->image = $request->image;

        }
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
            Owner::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }


    public function edit(Request $request)
    {
        $User = Owner::find($request->id);
        return view('Admin.Owner.model', compact('User'));
    }


    public function update(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'string|email',
            'phone' => 'required|string',
            'image' => 'nullable|image',
            'id_num' => 'required',

        ]);


        if (Owner::where('id_num', $request->id_num)->where('id', '!=', $request->id)->count() > 0) {
            return back()->with('message', 'id_num');

        }
        if (Owner::where('phone', $request->phone)->where('id', '!=', $request->id)->count() > 0) {
            return back()->with('message', 'phone');

        }
        if (Owner::where('email', $request->email)->where('id', '!=', $request->id)->count() > 0) {
            return back()->with('message', 'email');

        }

        $User = Owner::find($request->id);
        $User->name = $request->name;
        $User->phone = $request->phone;
        $User->email = $request->email;
        $User->id_num = $request->id_num;
        $User->id_num_expired = $request->id_num_expired;
        $User->id_num_export = $request->id_num_export;
        $User->district = $request->district;
        $User->nationality = $request->nationality;
        $User->tax_num = $request->tax_num;
        if ($request->file('image')) {
            $User->image = $request->image;

        }



        try {
            $User->save();
        } catch (\Exception $e) {
            return back()->with('message', 'Failed');
        }
        return redirect()->back()->with('message', 'Success');
    }






}
