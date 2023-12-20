<div>

    <h3 class="text-primary mb-3">تقرير الأرباح</h3>
    <form class="row g-1 mb-4 justify-content-center form-export">

        <div class="col">
            <lable class="text-primary fs-5 mb-3 d-block"> من تاريخ</lable>
            <input name="from" type="date" dir="ltr" class="form-control" value="{{ $from }}sss">
        </div>

        <div class="col">
            <lable class="text-primary fs-5 mb-3 d-block"> إلى تاريخ</lable>
            <input name="to" type="date" class="form-control" value="{{ $to }}">
        </div>
        <div class="col align-self-end">
            <button type="submit" class="btn btn-primary form-control mt-4">{{ __('view') }}</button>
        </div>

        <div class="col-1 text-start align-self-end">
            <a href="{{ route('screenshotGoogle')}}">
                <button type="button" class="btn btn-primary w-100" title="تحميل"><i class="fa fa-file"></i></button>
            </a>
        </div>
    </form>
    @if(isset($from) && isset($to))

        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th scope="col">البيان</th>
                <th scope="col">جزئي</th>
                <th scope="col">كلي</th>
            </tr>
            </thead>
            <tbody>
            <!-- <?php $invoiceitemprofit = 0 ?>
            @foreach($invoiceitems as $invoiceitem)
                <tr class="text-center">
                  <th scope="row">{{ $loop->iteration }}</th>
      <td>{{$invoiceitem->invoice->invoice_number}}</td>
      <td>{{$invoiceitem->invoice->sub_total}}</td>
      <td>{{$invoiceitem->profit}}</td>
    </tr>
    <?php $invoiceitemprofit = $invoiceitemprofit + $invoiceitem->profit ?>
            @endforeach -->


            <tr>
                <td> المبيعات</td>
                <!-- @dump(array_map( 'strval',[$this->from, $this->to])); -->
                <td>{{ \App\Models\Invoice::where('type', 0)->sum('sub_total') }} </td>
                <td></td>
            </tr>
            <tr>
                <td> مردود المشتريات</td>
                <td>{{ \App\Models\Invoice::where('type', 3)->sum('sub_total') }}</td>
                <td></td>
            </tr>
            <tr>
                <td> خصم مكتسب</td>
                <td>{{$invoice_earned_discount}}</td>
                <td></td>
            </tr>
            <tr>
            <tr>
                <td> مجموع الايرادات</td>
                <td></td><?php $invoice_earned_discountt = $invoice_earned_discount + \App\Models\Invoice::where('type', 0)->sum('sub_total') + \App\Models\Invoice::where('type', 3)->sum('sub_total') ?>
                <td>{{$invoice_earned_discountt}}</td>
            </tr>
            <tr>
                <td>يخصم منه: خصم مسموح به</td>
                <td>{{ $invoice_discountـpermitted  }} </td>
                <td></td>
            </tr>

            <tr>
                <td>صافي الايراد</td>
                <td></td><?php $net_revenue = $invoice_earned_discountt - $invoice_discountـpermitted ?>
                <td>{{ $net_revenue  }} </td>

            </tr>

            <tr>
                <td>يخصم من: تكلفة الايرادات</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td> مردود المبيعات</td>
                <td>{{ \App\Models\Invoice::where('type', 2)->sum('sub_total') }}</td>
                <td></td>
            </tr>

            <tr>
                <td>المشتريات</td>
                <td>{{ \App\Models\Invoice::where('type', 1)->sum('sub_total') }}</td>
                <td></td>
            </tr>

            <tr>
                <td>تكلفة الايرادات</td>
                <td></td><?php $net_revenuee = $net_revenue - \App\Models\Invoice::where('type', 1)->sum('sub_total') + \App\Models\Invoice::where('type', 2)->sum('sub_total') ?>
                <td>{{str_replace("-","",$net_revenuee)}}</td>

            </tr>

            <tr>
                <td>مجمل الربح/الخسارة</td>
                <td></td>
                <td>{{str_replace("-","",$net_revenuee)}}</td>

            </tr>

            <tr>
                <td>يخصم منه</td>
                <td></td>
                <td></td>
            </tr>

            @foreach($arrestreceipt as $arrestreceiptt)
                <tr>
                    <td>{{$arrestreceiptt->indexaccount->account_name}}</td>
                    <td>{{$arrestreceiptt->batch_quantity}}</td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td>مجموع يخصم منه</td>
                <td></td>
                <td>{{$arrestreceiptsum}}</td>
            </tr>

            <tr>
                <td>ارباح الفترة</td>
                <td></td>
                <td>{{str_replace("-","",$net_revenuee-$arrestreceiptsum)}}</td>
            </tr>
            <!--
    <tr>
      <td> المجموع الارباح</td>
      <td></td>
      <td>{{$invoiceitemssum}}</td>
    </tr> -->
            </tbody>
        </table>
    @endif
</div>