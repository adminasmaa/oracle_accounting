<div class="d-inline">


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
                    <!-- @dump($arrest_receipt); -->
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
                        <td>
                                <?php
                                $totalbalance = +$invoicestotal_price + $invoices->total_price; ?>
                            {{$invoices->balanceUser }}
                            {{$arrest_receipt->advance ??''}}
                        </td>
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

        @else
            <tr>
                <!-- <div class="mb-3 text-center fs-4 py-3"><div><img  width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty') }}</div> -->
            </tr>
        @endif

        <!-- ================================================================================== -->
        @if($invoiceuser != "")
            @foreach($invoiceuser as $invoiceusersid)
                @foreach($invoiceusersid->invoices as $invoices)
                    @foreach($invoices->arrest_receipts as $arrest_receipt)
                        <tr>
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
                            <td>
                                    <?php
                                    $totalbalance = +$invoicestotal_price + $invoices->total_price; ?>
                                {{$invoices->balanceUser }}
                                {{$arrest_receipt->advance ??''}}
                            </td>
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
            @endforeach

        @else
            <tr>
                <!-- <div class="mb-3 text-center fs-4 py-3"><div><img  width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty') }}</div> -->
            </tr>
        @endif


        </tbody>
    </table>


</div>