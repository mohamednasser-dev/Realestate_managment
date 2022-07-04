@extends('layouts.master')

@section('css')
@if(session('lang')=='en')
<!-- DataTables -->
<link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@else
<!-- DataTables -->
<link href="{{ URL::asset('rtl/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('rtl/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('rtl/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endif

@endsection

@section('breadcrumb')
<!-- Page-Title -->
<br>
<div class="app-content content container-fluid">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                {{trans('admin.ClientsList')}}
            </li>
            <li class="breadcrumb-item"><a href="{{url('recipts')}}"> {{trans('admin.reciepts')}} </a>
            </li>

        </ol>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')


@include('layouts.errors')



<div class="row">


    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                {{ Form::open( ['url' => ['recipt'],'method'=>'post'] ) }}
                {{ csrf_field() }}
                <div class="col-sm-12 row">
                    <div class="form-group row col-sm-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.fromdate')}}</label>
                        <div class="col-sm-10">
{{--                            <input name="fromdate" class="form-control" type="date" value="{{old('fromdate')}}" placeholder="{{trans('admin.fromdate')}}" required>--}}
                            <input name="fromdate" id="hijri-picker" class="form-control" type="text" value="{{old('fromdate')}}"
                                   placeholder="{{trans('admin.fromdate')}}" required>

                        </div>
                    </div>
                    <div class="form-group row col-sm-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.todate')}}</label>
                        <div class="col-sm-10">
{{--                            <input name="todate" class="form-control" type="date" value="{{old('todate')}}" placeholder="{{trans('admin.todate')}}" required>--}}
                            <input name="todate" id="hijri-picker2" class="form-control" type="text" value="{{old('todate')}}"
                                   placeholder="{{trans('admin.todate')}}" required>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12 row">
                    <div class="form-group row col-sm-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.reciepttype')}}</label>
                        <div class="col-sm-10">
                            {{ Form::select('type', array('قبض'=>'قبض','صرف'=>'صرف'),old('type')
                         ,["class"=>"form-control "]) }}
                        </div>
                    </div>
                    <div class="form-group row col-sm-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.pay_type')}}</label>
                        <div class="col-sm-10">
                            {{ Form::select('pay_type', array('all'=>'كل الحالات','نقد'=>'نقد','شبكه'=>'شبكه','شيك'=>'شيك','تحويل'=>'تحويل'),old('pay_type')
                         ,["class"=>"form-control "]) }}
                        </div>
                    </div>

                </div>
                <div class="">
                    <div class="form-group col-sm-6 row">
                        <label for="example-text-input" class="col-sm-2">الفرع</label>

                        <div class="col-sm-10">

                            {{ Form::select('branch_id',App\Branch::pluck('name','id'),old('branch_id')
                         ,["class"=>"form-control branch_id " ]) }}

                        </div>
                    </div>
                </div>
                <div class="row">
                {!! Form::submit( trans('admin.search') , ['class' => 'btn btn-info col-sm-6', 'name' => 'submitbutton', 'value' => 'search'])!!}
                {!! Form::submit( trans('admin.inexcel'), ['class' => 'btn btn-success col-sm-6', 'name' => 'submitbutton', 'value' => 'inexcel'])!!}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">


    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <table id="datatable" class="table table-striped  table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="font-family: Cairo;font-size: 18px;">
                        <tr style='text-align:center; font-family: Cairo;font-size: 18px;'>
                            <th>#</th>
                            <th>{{trans('admin.mainclient_name')}}</th>
                            <th>{{trans('admin.check_num')}}</th>
                            <th>{{trans('admin.reciept_num')}}</th>
                            <th>{{trans('admin.reciepttype')}}</th>
                            <th>{{trans('admin.recieptDate')}}</th>
                            <th>{{trans('admin.client_name')}}</th>
                            <th>المبلغ شامل الضريبه</th>
                            <th>المبلغ بدون الضريبة</th>
                            <th>الضريبه</th>
                            <th>الموظف</th>
                            <th></th>
                        </tr>
                    </thead>


                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($reciepts as $user)

                        <tr style='text-align:center'>
                            <td>{{$i}}</td>
                            <td>{{$user->getClient->getMainClient->name}}</td>
                            <td>{{$user->getClient->check_num}}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->type}}</td>
                            <td>{{$user->date}}</td>
                            <td>{{$user->getClient->name}}</td>
                            <td>{{$user->amount}}</td>
                            <td>{{$user->total}}</td>
                            <td>{{$user->amount - $user->total}}</td>
                            <td>{{$user->getUser->name}}</td>
{{--                            <td>{{$user->desc}}</td>--}}
                            <td>
                                @if($user->type != 'صرف')
                                    <a class='btn btn-raised btn-outline-success btn-sml' data-placement="top" title="فاتورة ضريبيه مبسطة" target="_blank" href="{{url('taxreset/'.base64_encode($user->id))}}"><i class="fa fa-print"></i>&nbsp;&nbsp; فاتورة ضريبية مبسطة </a>
                                    <a class='btn btn-raised btn-outline-primary btn-sml' data-placement="top" title="فاتورة ضريبيه" target="_blank" href="{{url('taxreset/'.base64_encode($user->id).'?type=d')}}"><i class="fa fa-print"></i>&nbsp;&nbsp; فاتورة ضريبية </a>
                                @endif
                                <a class='btn btn-raised btn-info btn-sml' data-placement="top" title="طباعه"target="_blank" href="{{url('recipts/'.$user->id)}}"><i class="fa fa-print"></i></a>

                                @php
                                $user_id=auth()->user()->id;
                                $permission =App\Permission::where('user_id',$user_id)->first();
                                @endphp
                                @if($permission->deleteinbox == 'yes')

                                <form method="get" id='delete-form-{{ $user->id }}' action="{{url('recipts/'.$user->id.'/delete')}}" style='display: none;'>
                                    {{csrf_field()}}
                                    <!-- {{method_field('delete')}}   -->
                                </form>
                                <button data-placement="top" title="حذف" onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                      {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $user->id }}').submit();
                      }else {
                            event.preventDefault();
                      }

                      " class='btn btn-raised btn-danger btn-sml' href=" "><i class="fa fa-trash" aria-hidden='true'>
                                    </i>
                                </button>
                                @endif
                            </td>
                        </tr>

                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('script')

    <script type="text/javascript">


        $(function () {

            initDefault();

        });

        function initDefault() {
            $("#hijri-picker").hijriDatePicker({
                hijri: true,
                showSwitcher: false
            });
            $("#hijri-picker2").hijriDatePicker({
                hijri: true,
                showSwitcher: false
            });
        }

    </script>


<!-- Required datatable js -->
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>

@endsection
