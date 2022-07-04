<table>
    <thead>
        <tr>
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
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($reciepts as $key=> $user)

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
        </tr>

        @php
        $i++;
        @endphp

        @endforeach
    </tbody>
</table>
