<!DOCTYPE html>
<html>

<head>
    <title> طباعه فاتورة ضريبية رقم {{$reciept->id}} </title>
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>

    <!-- Basic Css files -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <style>
        body {
            padding-top: 0%;

            font-family: 'Cairo';
            font-size: 17px;
        }

        a {
            border-bottom: 1px solid black;
            padding-bottom: 5px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

<div style="text-align:center; padding-top:50px;" class="row">
    <div class="form-group row">
        <div class="col-sm-4" style="text-align:right">
            <br>
            <br>
            @if($type)
                <h3>فاتورة ضريبية </h3>
            @else
                <h3>فاتورة ضريبية مبسطة</h3>
            @endif
        </div>

        <div class="col-sm-4" style=" padding-top:10px;font-family: 'Cairo';font-size: 22px;text-align:right">
            <br>
            <br>
            <strong>{{$maindata->name_ar}} </strong> <br>

            <strong> العنوان : </strong> {{$branch_data->address}} <br>
            <strong> الجوال : </strong> {{$branch_data->phone}} <br>


        </div>
        <div class="col-sm-4"
             style=" padding-top:10px;padding-right:50px;font-family: 'Cairo';font-size: 22px;text-align:right">

            <img src="{{url('uploads/'. $maindata->logo)}}" width="200px" height="200px">

        </div>

        <div style="padding-top: 25%"></div>
        <div class="col-sm-6 form-group" style="text-align:right;padding-right:50px">
            <div>
                <br>
                <strong> رقم الفاتورة : </strong>
                {{$reciept->id}} <br>
                <strong> الرقم الضريبي : </strong>
                300419725400003 <br>
                <strong> التاريخ : </strong>
                {{date('d-m-Y', strtotime($reciept->date))}} <br>

            </div>

        </div>

        <div class="col-sm-6 form-group" style="text-align:right;padding-right:50px">
            <strong>: العميل </strong>
            <div style="padding-right:80px">
                <strong> الاسم : </strong>
                {{$reciept->getClient->getMainClient->name}} <br>

                <strong> العنوان : </strong>
                {{$reciept->getClient->getMainClient->address}} <br>
                <strong> الجوال : </strong>
                {{$reciept->getClient->getMainClient->phone}} <br>

            </div>
        </div>
        <div style="padding-top: 15%"></div>
        <div class="container">
            <div class="col-sm-12 form-group" style="text-align:center;padding-left: 1%">
                <table>
                    <tr>
                        <th style="width:15%">المبلغ</th>
                        <th style="width:15%">المشروع</th>
                        <th style="width:70%">الوصف</th>
                    </tr>
                    <tr>
                        <td> {{$reciept->total }}   </td>
                        <td>{{$reciept->getClient->name}}</td>
                        <td>{{$reciept->desc}}</td>


                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-6 form-group" style="text-align:right;padding-right:20%">
            <div>
                <strong> المبلغ غير شامل الضريبه : </strong>
                {{$reciept->total }} ر.س<br>
                <hr>
                <strong> اجمالى الضريبة المضافة /% {{$reciept->getClient->taxepercent}} : </strong>
                {{$reciept->amount - $reciept->total}} ر.س<br>
                <hr>
                <strong> الاجمالى شامل الضريبة : </strong>
                {{$reciept->amount}} ر.س<br>
                <hr>
            </div>

        </div>
        <div class="col-sm-6 form-group" style="text-align:right;padding-right:40%">
            <div>
            {{--            @php--}}
            {{--                $data = $QRCode;--}}
            {{--            @endphp--}}

            <!-- //QRCODE must have string  -->
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($QRCode, 'QRCODE',4,4)}}" alt="barcode"/>

            </div>

        </div>
        <div class="col-sm-6 form-group"></div>


    </div>
</div>

<div style="text-align:center; padding-top:100px;" class="row">

    <div style="padding-top: 200px;"></div>


    <div class="col-sm-12 form-group" style="text-align:center">
        <div>
            <p> {{$branch_data->address}} - {{$branch_data->phone}}</p>
        </div>
    </div>
</div>

<script>
    window.print();
</script>
</body>

</html>
