<div>

    <h3 class="text-primary">تقرير حركة الاصناف</h3>
    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th class="text-primary" scope="col">رقم الحركة</th>
            <th class="text-primary" scope="col">الاسم</th>
            <th class="text-primary" scope="col">السيريال</th>
            <th class="text-primary" scope="col">الرقم</th>
            <th class="text-primary" scope="col">التاريخ</th>
            <th class="text-primary" scope="col">الوقت</th>
            <th class="text-primary" scope="col">الكمية الواردة</th>
            <th class="text-primary" scope="col">الكمية الصادرة</th>
            <th class="text-primary" scope="col">الرصيد</th>
            <th class="text-primary" scope="col">سعر الوحدة</th>
            <th class="text-primary" scope="col">الوصف</th>

        </tr>
        </thead>
        <tbody>

        @foreach($invoice as $invoices)
            @foreach($invoices->invoice_items as $invoicesitem)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$invoicesitem->item->name}}</td>
                    <td>{{$invoicesitem->item->item_number}}</td>
                    <td>{{$invoicesitem->item->item_number}}</td>
                    <td>{{$invoices->created_at->format('d/m/Y') }}</td>
                    <td>{{$invoices->created_at->format('H:i:s') }}</td>
                    @if($invoices->type == 1)
                        <td>{{$invoicesitem->quantity ??''}}</td>
                        <td>-</td>
                    @elseif($invoices->type==0)
                        <td>-</td>
                        <td>{{$invoicesitem->quantity ??''}}</td>
                    @else
                        <td>-</td>
                    @endif
                    @if($invoices->type == 1)
                        <td>{{$invoicesitem->invoice_update}}</td>
                        <td>{{$invoicesitem->purchasing_price}}</td>
                    @else
                        <td>{{$invoicesitem->invoice_update}}</td>
                        <td>{{$invoicesitem->selling_price}}</td>
                    @endif
                    <td> تقرير حركة الصنف</td>
                </tr>
            @endforeach
        @endforeach

        <!-- @foreach($item as $items)
            <tr class="text-center">
                <td> {{$loop->iteration }}</td>
      <td>{{$items->created_at->format('d/m/Y')}} </td>
      <td>{{$items->created_at->format('H:i:s')}} </td>
      <td>{{$items->name}} </td>
      <td>{{$items->item_number}} </td>
      <td>{{$items->serial_number}} </td>
      <td>{{$items->qty}} </td>
      <td> - </td>

  </tr>

        @endforeach -->


        </tbody>
    </table>

</div>