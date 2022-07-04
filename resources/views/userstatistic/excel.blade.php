<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{trans('admin.username')}}</th>
            <th>{{trans('admin.countReciept')}}</th>
            <th> اجمالى المبالغ بالضريبه</th>
            <th>اجمالى المبالغ بدون الضريبه</th>
            <th>اجمالى تحصيل موظفين الفرع بالضريبه</th>
            <th>اجمالى تحصيل موظفين الفرع بدون ضريبه</th>

        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($users as $key=> $data)

        <tr style='text-align:center'>
            <td>{{$i}}</td>
            <td>{{$data->name}}</td>
            @if($from !=null && $to !=null)
            <td>{{$data->Reciept->where('type', 'قبض')->whereBetween('date',[$from,$to])->count()}}</td>
            <td>{{$data->Reciept->where('type', 'قبض')->whereBetween('date',[$from,$to])->sum('amount')}}</td>
            <td>{{$data->Reciept->where('type', 'قبض')->whereBetween('date',[$from,$to])->sum('total')}}</td>
            @else
                <td>{{$data->Reciept->where('type', 'قبض')->count()}}</td>
                <td>{{$data->Reciept->where('type', 'قبض')->sum('amount')}}</td>
                <td>{{$data->Reciept->where('type', 'قبض')->sum('total')}}</td>
            @endif
        </tr>

        @php
        $i++;
        @endphp

        @endforeach
        <td>{{$reciept}}</td>
        <td>{{$reciept_total}}</td>
    </tbody>
</table>
