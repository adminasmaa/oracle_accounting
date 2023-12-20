<div>

    <h3 class="text-primary">تقرير فواتير البيع</h3>
    <form class="row mb-4 justify-content-center form-export">
        <div class="col text-start">
            <input name="from" type="date" class="form-control" value="{{ $from }}">
        </div>

        <div class="col text-start">
            <input name="to" type="date" class="form-control" value="{{ $to }}">
        </div>


        <div class="col text-start">
            <!-- <a href="{{ route('screenshotGoogle')}}"> <button type="button" class="btn btn-sm text-success "> <i class="fa fa-file"></i> </button> </a> -->
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>

    <table class="table table-responsive-md table-borderless">
        <thead>
        <tr>
            <th class="text-center p-1" scope="col">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
            </th>
            <th class="text-center p-1" scope="col">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الفاتورة</div>
            </th>
            <th class="text-center p-1" scope="col">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تاريخ الفاتورة</div>
            </th>
            <th class="text-center p-1" scope="col">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم العميل</div>
            </th>
            <th class="text-center p-1" scope="col">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">مبلغ الفاتورة</div>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php $totalpricee = 0 ?>
        @foreach($invoice as $invoices)
            <tr>
                <td class="text-center p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                </td>
                <td class="text-center p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">{{$invoices->invoice_number}} </div>
                </td>
                <td class="text-center p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">{{$invoices->invoice_date}} </div>
                </td>
                <td class="text-center p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">{{$invoices->user->name ??''}} </div>
                </td>
                <td class="text-center p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">{{$invoices->total_price}} </div>
                </td>
                    <?php $totalpricee = $totalpricee + $invoices->total_price ?>
            </tr>
        @endforeach


        <tr>
            <td colspan="3" align="center">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p fw-bold">المجموع</div>
            </td>
            <td colspan="2" align="center">
                <div class="bg-white rounded-2 p-1 min-h-40p fw-bold"> {{$totalpricee}} </div>
            </td>
        </tr>


        </tbody>
    </table>

</div>