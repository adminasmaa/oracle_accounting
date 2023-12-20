<div>

    <h3 class="text-primary">تقرير حركة الصنف</h3>

    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th scope="col">رقم الحركة</th>
            <th scope="col">اسم الصنف</th>
            <th scope="col">التاريخ</th>
            <th scope="col">وقت الاضافة</th>
            <th scope="col">الكمية الواردة</th>
            <th scope="col">الكمية الصادرة</th>
            <th scope="col">الكمية المتوفرة</th>
        </tr>
        </thead>
        <tbody>
        <?php $quantity = 0 ?>


        @foreach($item->invoice_items as $invoice_item)
                @php
                    if($invoice_item->invoice->type == 0){
                        $quantity = $quantity-$invoice_item->quantity;
                    }else{
                        $quantity = $quantity+$invoice_item->quantity;
                    }
                @endphp
                <tr class="text-center">
                    <td> {{$loop->iteration }}</td>
                    <td>{{$invoice_item->item->name}} </td>
                    <td>{{$invoice_item->invoice->invoice_date}} </td>
                    <td>{{$invoice_item->created_at->format('Y-m-d H:i:s')}} </td>
                    <td>{{$invoice_item->invoice->type == 1 ? $invoice_item->quantity : ''}} </td>
                    <td>{{$invoice_item->invoice->type == 0 ? $invoice_item->quantity : ''}} </td>
                    <td>{{$quantity}} </td>
                </tr>

        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> <b>الاجمالي</b></td>
            <td> <b>{{$quantity}}</b></td>
        </tr>


        </tbody>
    </table>

</div>