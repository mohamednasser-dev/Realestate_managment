@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
    <!-- Page-Title -->
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{ url('branch') }}"> {{trans('admin.branchs')}}
                    </a>
                </li>

                <li class="breadcrumb-item">
                    {{trans('admin.addbranch')}}
                </li>

            </ol>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @include('layouts.errors')

            <div class="card m-b-20">
                <div class="card-body">

                    {{ Form::open( ['url' => ['branch'],'method'=>'post'] ) }}
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.Name')}}</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{old('name')}}"
                                   placeholder="{{trans('admin.Name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم الجوال</label>
                        <div class="col-sm-10">
                            <input name="phone" class="form-control" type="text" value="{{old('phone')}}"
                                   placeholder="رقم الجوال" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">العنوان</label>
                        <div class="col-sm-10">
                            <input name="address" class="form-control" type="text" value="{{old('address')}}"
                                   placeholder="العنوان" required>
                        </div>
                    </div>


                    {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

@endsection

@section('script')
@endsection
