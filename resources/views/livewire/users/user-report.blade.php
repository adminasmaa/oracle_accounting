<div class="d-inline">
    <!-- <button type="button" class="btn btn-sm text-success " data-bs-toggle="modal"
        data-bs-target=".modalFormReportUser{{$user['id']}}">
        <i class="fa fa-file"></i>
    </button> -->


    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th scope="col">رقم الحركة</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الوقت</th>
            <th scope="col">مدين</th>
            <th scope="col">دائن</th>
            <th scope="col">الرصيد</th>
            <th scope="col">سعر الوحدة</th>
            <th scope="col">الوصف</th>

        </tr>
        </thead>
        <tbody>
        <?php $invoicestotal_price = 0; ?>
        @if($invoice != "")
            @foreach($invoice as $invoices)
                @foreach($invoices->arrest_receipts as $arrest_receipt)
                    <tr>
                        <!-- //sub_total -->
                        <td> {{$loop->iteration }}</td>
                        <td> {{$invoices->invoice_date}}</td>
                        <td> {{$invoices->created_at->format('H:i:s')}}</td>
                        <td> {{$invoices->sub_total}}</td>
                        <td> -</td>
                        <td> {{$invoices->sub_total}}</td>
                        <td> -</td>
                        <td> {{$invoices->description}}
                            @if($invoices->type == 1)
                                فاتورة شراء
                            @elseif($invoices->type == 0)
                                فاتورة بيع
                            @endif

                        </td>

                    </tr>
                    <tr>
                        <td> {{$loop->iteration }}</td>
                        <td> {{$arrest_receipt->created_at->format('d/m/Y')}}</td>
                        <td> {{$arrest_receipt->created_at->format('H:i:s')}}</td>
                        <td> -</td>
                        <td> {{$arrest_receipt->batch_quantity}}</td>
                            <?php
                            $totalbalance = +$invoicestotal_price + $invoices->total_price; ?>
                        <td> {{$invoices->balanceUser }}</td>
                        <td> -</td>
                        <td> {{$arrest_receipt->description}}
                            @if($invoices->type == 1)
                                فاتورة شراء
                            @elseif($invoices->type == 0)
                                فاتورة بيع
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach

            <!-- @foreach($arrestreceipt as $arrestreceipt1)
                <tr>
                  <td> {{$arrestreceipt1->user_id}}</td>
                <td>{{$arrestreceipt1->date}}</td>
                <td> {{$arrestreceipt1->created_at->format('H:i:s')}}</td>
                <td>{{$arrestreceipt1->advance}}</td>
                <td> </td>
                <td> {{$arrestreceipt1->balance}}</td>
                <td> - </td>
                <td>{{$arrestreceipt1->description}} </td>
              </tr>
              <tr>
                <td> {{$arrestreceipt1->user_id}}</td>
                <td>{{$arrestreceipt1->date}}</td>
                <td> {{$arrestreceipt1->created_at->format('H:i:s')}}</td>
                <td></td>
                <td> {{$arrestreceipt1->reportuser}}</td>
                <td> </td>
                <td> - </td>
                <td>{{$arrestreceipt1->description}} </td>
              </tr>

            @endforeach -->

        @elseif($invoice == "")

        @else

        @endif


        </tbody>
    </table>


</div>