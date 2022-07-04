@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    @if(session('lang')=='en')
        <!-- DataTables -->
        <link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>
        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>

        <link href="{{ URL::asset('assets/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css"/>
    @else
        <!-- DataTables -->
        <link href="{{ URL::asset('rtl/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ URL::asset('rtl/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>
        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('rtl/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
              type="text/css"/>

        <link href="{{ URL::asset('assets/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css"/>
    @endif

@endsection
@section('breadcrumb')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                    </ol>
                </div>
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>
@endsection

@section('content')



        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-white">
                    <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fa fa-users"></i></span>
                    <div class="mini-stat-info">
                        <span class="counter text-purple float-center">{{$numberofmessages}}</span>
                       الميزانية المتاحه
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-white">
                    <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fa fa-toggle-right"></i></span>
                    <div class="mini-stat-info">
                        <span class="counter text-black float-center">{{$usedsms}}</span>
المستخدم                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-white">
                    <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fa  fa-toggle-left"></i></span>
                    <div class="mini-stat-info">
                        <span class="counter text-black float-center">{{$remainsms}}</span>
                       المتبقى
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>


         <div class="row">


            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="card-header" style="text-align: center;">
                            <strong>الرسائل المرسلة</strong>
                        </div>

                        <table id="datatable" class="table table-striped  table-bordered dt-responsive nowrap"
                               cellspacing="0" width="100%">
                            <thead style="font-family: Cairo;font-size: 18px;">
                            <tr style='text-align:center; font-family: Cairo;font-size: 18px;'>
                                <th>#</th>
                                <th>الرقم</th>
                                <th>الرسالة</th>
                                <th>الوقت</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                                 @foreach($sms as $user)

                                    <tr style='text-align:center'>
                                        <td>{{$i}}</td>
                                        <td>{{$user->number}}</td>
                                        <td>{{$user->sms}}</td>
                                        <td>{{$user->created_at}}</td>

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
