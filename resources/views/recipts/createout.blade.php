@extends('layouts.master')

@section('css')
<link href="{{url('css/select2.min.css')}}" rel="stylesheet" />

<style>
    #parent {
        /* can be any value */
        width: 300px;
        text-align: right;
        direction: rtl;
        position: relative;
    }

    #parent .select2-container--open+.select2-container--open {
        left: auto;
        right: 0;
        width: 100%;
    }
</style>
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


            <li class="breadcrumb-item">
                {{trans('admin.addoutreciept')}}
            </li>

        </ol>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-7">
        @include('layouts.errors')

        <div class="card m-b-20">
            <div class="card-body">

                {{ Form::open( ['url' => ['recipts'],'method'=>'post'] ) }}
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.recieptDate')}}</label>
                    <div class="col-sm-10">
                        <input name="type" class="form-control" type="hidden" value="صرف">
                        <input name="date" id="hijri-picker" class="form-control" type="text" value="{{old('date')}}"
                               placeholder="{{trans('admin.date')}}" required>

{{--                        <input name="date" class="form-control" type="date" value="{{old('date')}}" placeholder="{{trans('admin.date')}}" required>--}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.pay_type')}}</label>
                    <div class="col-sm-10">
                        {{ Form::select('pay_type', array('نقد'=>'نقد','شبكه'=>'شبكه','شيك'=>'شيك','تحويل'=>'تحويل'),old('pay_type')
                         ,["class"=>"form-control "]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2">{{trans('admin.mainclient_name')}}</label>

                    <div class="col-sm-10" id="parent">

                        <select id="mainclient" class="itemName form-control" style="text-align-last: right;"
                                name="mainclient_id">


                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2">{{trans('admin.clientName')}}</label>

                    <div class="col-sm-10" id="parent">

                        <select id="client" class=" form-control" style="text-align-last: right;"
                                name="client_id">


                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.totalaftertaxes')}}</label>
                    <div class="col-sm-10">
                        <input name="amount" id="amount" class="form-control" type="number" value="{{old('amount')}}" placeholder="{{trans('admin.totalaftertaxes')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.taxepercent')}}</label>

                    <div class="col-sm-10">
                        <input name="taxepercent" id="taxe" class="form-control" type="number" value="{{old('taxepercent')}}" placeholder="{{trans('admin.taxepercent')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.amount')}}</label>

                    <div class="col-sm-10">
                        <input name="total" id="total" class="form-control" type="number" value="{{old('total')}}" placeholder="{{trans('admin.amount')}}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('admin.descri')}}</label>
                    <div class="col-sm-10">
                        <textarea name="desc" class="form-control" placeholder="{{trans('admin.descri')}}"></textarea>
                    </div>
                </div>

                {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info btn-block']) }}
                {{ Form::close() }}
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="col-5">
        <table id="table" class="table table-striped  table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead style="font-family: Cairo;font-size: 18px;">
            <tr style='text-align:center; font-family: Cairo;font-size: 18px;'>
                <th>{{trans('admin.clientName')}}</th>
                <th>{{trans('admin.check_num')}}</th>
                <th>{{trans('admin.part_number')}}</th>
                <th>{{trans('admin.scheme_number')}}</th>

            </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
    </div>
</div>

@endsection

@section('script')

<script>
    $(function() {
        $("#total").on('click', function() {
            var taxe = document.getElementById('taxe').value;
            var amount = document.getElementById('amount').value;

            var total = amount / (1+taxe / 100);
            // var taxamount = amount - total;

            // var amount = +total + +(total * taxe / 100);


            document.getElementById('total').value = Math.ceil(total);

        });
        // $("#client").on('change', function() {
        //     var id = document.getElementById("client").value;
        //
        //     $.ajax({
        //         url: "/clientdata/" + id,
        //         dataType: "json",
        //         success: function(html) {
        //             $('#check_num').val(html.data_client.check_num);
        //             $('#part_number').val(html.data_client.part_number);
        //             $('#scheme_number').val(html.data_client.scheme_number);
        //
        //         }
        //     })
        // });
    });
</script>
<script>
    $(function () {
        $("#mainclient").on('change', function () {
            var id = document.getElementById("mainclient").value;
            console.log(id);

            $.ajax({
                url: "/clientdata/" + id,
                dataType: "json",
                success: function (html) {
                    $('#client').empty();
                    $("#client").append('<option>--اختر  اسم المشروع--</option>');
                    if(html)
                    {
                        $.each(html.data_client,function(key,value){
                            $('#client').append($("<option/>", {
                                value: value,
                                text: key
                            }));
                        });
                        var res='';
                        $.each (html.data_client_table, function (key, value) {
                            res +=
                                '<tr style="text-align:center; font-family: Cairo;font-size: 18px;">'+
                                '<td>'+value.name+'</td>'+
                                '<td>'+value.check_num+'</td>'+
                                '<td>'+value.part_number+'</td>'+
                                '<td>'+value.scheme_number+'</td>'+
                                '</tr>';

                        });

                        $('tbody').html(res);
                    }

                }
            })
        });
    });
</script>
<script>
    $(function () {
        $("#client").on('change', function () {
            var id = document.getElementById("client").value;
            console.log(id);

            $.ajax({
                url: "/clientdata/" + id,
                dataType: "json",
                success: function (html) {

                    var amount = html.data_project.amount;
                    var phone = html.data_project.phone;
                    var pays = html.data_client_reciept;
                    var subtotal = amount - pays;
                    $('#amounts').val(amount);
                    $('#suubtotal').val(subtotal);
                    $('#phone').val(phone);

                }
            })
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.itemName').select2({
            placeholder: '  ابحث باسم العميل او رقم الهويه او رقم الجوال',
            dir: 'rtl',
            dropdownParent: $('#parent'),
            ajax: {
                url: '/select2-autocomplete-ajax',
                dataType: 'json',
                delay: 1500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
<script type="text/javascript">


    $(function () {

        initDefault();

    });

    function initDefault() {
        $("#hijri-picker").hijriDatePicker({
            hijri: true,
            showSwitcher: false
        });
    }

</script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

@endsection
