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
                {{trans('admin.websiteControll')}}
            </li>
            <li class="breadcrumb-item"> {{trans('admin.featuredworks')}}



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
        <div>
            <div>
                <a href="{{url('works/create')}}  " class="btn btn-info btn-block">{{trans('admin.addwork')}} </a>

            </div>
        </div>
        <div class="card m-b-20">
            <div class="card-body">

                <table id="datatable" class="table table-striped  table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="font-family: Cairo;font-size: 18px;">
                        <tr style='text-align:center; font-family: Cairo;font-size: 18px;'>
                            <th>#</th>
                            <th>{{trans('admin.title_en')}}</th>
                            <th>{{trans('admin.title_ar')}}</th>
                            <th>{{trans('admin.descr_ar')}}</th>
                            <th>{{trans('admin.descr_en')}}</th>
                            <th>{{trans('admin.category')}}</th>

                            <th></th>
                        </tr>
                    </thead>


                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($products as $user)

                        <tr style='text-align:center'>

                            <td>{{$i}}</td>
                            <td>{{$user->title_en}}</td>
                            <td>{{$user->title_ar}}</td>
                            <td>{{$user->desc_ar}}</td>
                            <td>{{$user->desc_en}}</td>
                            @if(session('lang')=='en')
                            <td>{{$user->getCategory->name_en}}</td>
                            @else
                            <td>{{$user->getCategory->name_ar}}</td>
                            @endif
                            </td>
                            <td>
                                @php
                                $user_id=auth()->user()->id;
                                $permission =App\Permission::where('user_id',$user_id)->first();
                                @endphp
                                @if($permission->deleteinbox == 'yes')
                                <a class='btn btn-raised btn-success btn-sml' href=" {{url('works/'.$user->id.'/edit')}}"><i class="fa fa-edit"></i></a>
                                <form method="get" id='delete-form-{{ $user->id }}' action="{{url('works/'.$user->id.'/delete')}}" style='display: none;'>
                                    {{csrf_field()}}
                                    <!-- {{method_field('delete')}}   -->
                                </form>
                                <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
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
                                <a class='btn btn-raised btn-info btn-sml' data-placement="top" title="?????? ?????? ??????????"  href=" {{url('workimages/'.$user->id)}}"><i class="fa fa-eye"></i></a>

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