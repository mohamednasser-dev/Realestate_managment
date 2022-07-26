@extends('layouts.master')

@section('css')
@if(session('lang')=='en')
<!-- DataTables -->
<link href="{{ URL::asset('admin/en/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin/en/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin/en/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('admin/en/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@else
<!-- DataTables -->
<link href="{{ URL::asset('admin/ar/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin/ar/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin/ar/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('admin/ar/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endif

@endsection

@section('breadcrumb')
<h3 class="page-title">{{trans('admin.mainclients')}}</h1>
@endsection

@section('content')

<div class="page-content-wrapper">
    <div class="container-fluid" @if(session('lang')=='en') @else dir="rtl" @endif>
        @include('layouts.errors') 

        <div class="card m-b-20">
            <div class="card-body">

                <table id="datatable" class="table table-striped  table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="font-family: Cairo;font-size: 18px;">
                        <tr style='text-align:center; font-family: Cairo;font-size: 18px;'>
                            <th style="width: 25px;"><input type="checkbox" id="checker"></th>
                            <th>الاسم</th>
                            <th>النوع</th>
                            <th>رقم الجوال</th>
                            <th>العنوان</th>
                            <th>رقم الهوية</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<!-- sample modal content -->
<div id="addModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">فلتر العملاء</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" dir="rtl">

                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-12 col-form-label">اسم القسم</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" value="" name="name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-12 col-form-label">اسم القسم انجليزي</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" value="" name="name_en" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-12 col-form-label">متفرع من</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="parent">
                                        <option value="0">قسم 1</option>
                                        <option value="0">قسم 1</option>
                                        <option value="0">قسم 1</option>
                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Meta Keywords</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" value="" name="meta_keywords">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Meta Description</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" value="" name="meta_description">
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <label class="pull-right">صورة القسم</label>
                                <input type="file" class="filestyle" name="photo" id="photo_link" data-buttonname="btn-secondary">
                                <br>
                                    <img class="img-thumbnail" id="get_photo_link" style="width: 200px;" src="https://via.placeholder.com/200x150/EFEFEF/AAAAAA&amp;text=no+image" data-holder-rendered="true">
                            </div>

                        </div>
                    </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                  </div>
                </form>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
@if(session('lang')=='en')
<!-- Required datatable js -->
<script src="{{ URL::asset('admin/en/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/alertify/js/alertify.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('admin/en/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('admin/en/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('admin/en/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
@else
<!-- Required datatable js -->
<script src="{{ URL::asset('admin/ar/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/alertify/js/alertify.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('admin/ar/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('admin/ar/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('admin/ar/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

@endif
<!-- Datatable init js -->

<script type="text/javascript">
    $(function () {
        var table = $('#datatable').DataTable({
            processing: false,
            serverSide: true,
            autoWidth: false,
            searching: false,
            responsive: true,
            aaSorting: [],
            "dom": "<'border-0 p-0 pt-6'<'card-title' <'d-flex align-items-center position-relative my-1'f> r> <'card-toolbar' <'d-flex justify-content-end add_button'B> r>>  <'row'l r> <''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "الكل"]],
            "language": {
                search: '',
                searchPlaceholder: 'بحث سريع'
            },
            buttons: [
                {
                    extend: 'print',
                    className: 'btn btn-info m-1',
                    text: '<i class="dripicons-print"></i>'
                },
                // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                {
                    extend: 'excel',
                    className: 'btn btn-success m-1',
                    text: '<i class="dripicons-download"></i>'
                },
                {
                    text: '<i class="dripicons-experiment"></i>',
                    className: 'btn btn-warning m-1',
                    action: function ( e, dt, node, config ) {
                        $('#addModel').modal('show');
                    }
                },
                {
                    text: 'اضف عميل',
                    className: 'btn btn-purple m-1',
                    action: function ( e, dt, node, config ) {
                        window.location.href = "{{url('mainclient/create')}}"
                    }
                },
                {
                    text: 'حذف عميل',
                    className: 'btn btn-danger m-1 btn_delete'
                }
                // {extend: 'colvis', className: 'btn secondary', text: 'إظهار / إخفاء الأعمدة '}
            ],
            ajax: {
                url: '{{ route('cpanel.datatable.data') }}',
                data: {}
            },
            columns: [
                {data: 'checkbox', name: 'checkbox', "searchable": false, "orderable": false},
                {data: 'name', name: 'name', "searchable": true, "orderable": true},
                {data: 'type', name: 'type', "searchable": true, "orderable": true},
                {data: 'phone', name: 'phone', "searchable": true, "orderable": true},
                {data: 'address', name: 'address', "searchable": true, "orderable": true},
                {data: 'id_num', name: 'id_num', "searchable": false, "orderable": false},
                {data: 'actions', name: 'actions', "searchable": false, "orderable": false},
            ]
        });

        $("#checker").click(function(){
            var items = document.getElementsByTagName("input");

            for(var i=0; i<items.length; i++){
                if(items[i].type=='checkbox') {
                    if (items[i].checked==true) {
                        items[i].checked=false;
                    } else {
                        items[i].checked=true;
                    }
                }
            }

        });

        $(".btn_delete").click(function(event){
            event.preventDefault();
            var checkIDs = $("#datatable input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDs.length > 0) {
                var token = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "#",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDs,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.msg == "Success") {
                                    location.reload();
                                    alertify.log("Standard log message");
                                } else {
                                    alertify.log("Standard log message");
                                }
                            },
                            fail: function(xhrerrorThrown){

                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            }

        });

    });
</script>
@endsection
