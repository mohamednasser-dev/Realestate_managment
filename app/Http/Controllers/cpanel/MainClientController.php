<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\MainClient;
use Illuminate\Http\Request;

class MainClientController extends Controller
{
    public function index()
    {
        return view('mainclient.index');
    }

    public function datatable(Request $request)
    {

        $data = MainClient::orderBy('id', 'desc');
        return Datatables::of($data)
            ->editColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="' . $row->id . '" name="check_delete{}" id="customControlInline' . $row->id . '">
                                <label class="custom-control-label" for="customControlInline' . $row->id . '"></label>
                            </div>';
                return $checkbox;
            })
            ->editColumn('name', function ($row) {
                $name = '';
                $name .=  $row->name ;
                return $name;
            })
            ->editColumn('phone', function ($row) {
                $phone = '';
                $phone .= $row->phone;
                return $phone;
            })->editColumn('type', function ($row) {
                $type = '';
                $type .=  $row->type;
                return $type;
            })
            ->editColumn('address', function ($row) {
                $address = '';
                $address .= $row->address;
                return $address;
            })

            ->editColumn('id_num', function ($row) {
                $id_num = '';
                $id_num .= $row->id_num;
                return $id_num;
            })

            ->addColumn('actions', function ($row) {
                $actions = '';
                
                $actions .= ' <a class="btn btn-raised btn-success btn-sml" href=" '.url('mainclient/'.$row->id.'/edit').'"><i class="fa fa-edit"></i></a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'phone', 'type', 'id_num', 'address'])
            ->make();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mainclient.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(
            \request(),
            [
                'name' => 'required',
                'id_num' => 'required',
                'address' => 'required',
                'type' => 'required|in:0,1',
                'phone' => 'required|unique:main_clients|regex:/(9665)[0-9]{7}/',
            ]
        );

        MainClient::create($data);
        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('mainclient'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = MainClient::where('id', $id)->first();
         return view('mainclient.edit', \compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(
            \request(),
            [
                'name' => 'required',
                'id_num' => 'required',
                'address' => 'required',
                'type' => 'required|in:0,1',
                'phone' => 'required|regex:/(9665)[0-9]{7}/|unique:main_clients,phone,' . $id,
            ]
        );



        MainClient::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updatedsuccess'));
        return redirect(url('mainclient'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = MainClient::findOrFail($id);
        $cat->delete();
        session()->flash('success', trans('admin.deletesuccess'));
        return redirect(url('mainclient'));
    }
}
