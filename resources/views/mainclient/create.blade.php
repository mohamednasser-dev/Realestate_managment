@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<h3 class="page-title">{{trans('admin.addmainclient')}}</h1>
@endsection

@section('content')

<div class="page-content-wrapper">
    <div class="container-fluid" @if(session('lang')=='en') @else dir="rtl" @endif>
        @include('layouts.errors') 

        <div class="card m-b-20">
            <div class="card-body">

                {{ Form::open( ['url' => ['mainclient'],'method'=>'post'] ) }}
                {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2">{{trans('admin.mainclient_name')}}</label>

                        <div class="col-sm-9">
                            <input name="name" class="form-control" type="text" value="{{old('name')}}"
                                   placeholder="{{trans('admin.mainclient_name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2">{{trans('admin.id_num')}}</label>

                        <div class="col-sm-9">
                            <input name="id_num" class="form-control" type="number" value="{{old('id_num')}}"
                                   placeholder="{{trans('admin.id_num')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2">{{trans('admin.address')}}</label>

                        <div class="col-sm-9">
                            <input name="address" class="form-control" type="text" value="{{old('address')}}"
                                   placeholder="{{trans('admin.address')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2">{{trans('admin.phone')}}</label>

                        <div class="col-sm-9">
                            <input name="phone" class="form-control" type="number" value="{{old('phone')}}"
                                   placeholder="{{trans('admin.phone')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2">النوع</label>

                        <div class="col-sm-4">
                            <input type="radio" id="ee" class="radio radio-inline" name="type" value="0" checked>
                            <label for="ee" class="col-sm-4">  <b>عميل</b>  </label>
                        </div>
                        <div class="col-sm-4">
                            <input type="radio" id="te" class="radio radio-inline" name="type" value="1">
                            <label for="te" class="col-sm-4"> <b>شركة/مورد</b> </label>
                        </div>
                    </div>

                {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </div>
        
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

@endsection

@section('script')
@endsection
