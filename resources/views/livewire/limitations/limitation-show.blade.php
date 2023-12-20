<div class="row">
    <div class="col-5">
        <!-- <button wire:click="addpayroll" type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                data-bs-target="#modalFormaddpayroll">
                انشاء قيود
            </button> -->
        <h4 class="text-primary"> القيود </h4>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <lable> رقم القيد</lable>
            <input class="form-control" value="{{ $items->id }}" disabled/>
        </div>
        <div class="col-3">
            <lable> التاريخ القيد</lable>
            <input class="form-control" value="{{ $items->created_at->format('Y-m-d') }}" disabled/>
        </div>
        <div class="col-3">
            <lable>الساعة</lable>
            <input class="form-control" value="{{ $items->created_at->format('H:i:s') }}" disabled/>
        </div>
    </div>

    <div class="table-responsive-sm mt-3">
        @if($items->count())
            <table class="table table-responsive-md table-borderless">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> اسم الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">مدين</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">دائن</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">بيان الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">مبلغ الحساب</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($items->type !=1 & $items->type != 2)
                    @if($items->arrest_receipt_id)
                        <tr>

                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">
                                    @if($items->arrestreceipt->type == "1")
                                        سندات الصرف
                                    @else
                                        ايصالات القبض
                                    @endif
                                </div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">
                                        <?php $user = App\Models\User::find($items->arrestreceipt->user_id); ?>
                                    @if(isset($user))
                                        {{  $user->salary }}</div>
                            </td>
        @else
    </div>
    </td>
    @endif
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p"> {{$items->arrestreceipt->description}}</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">
        @if(isset($user))
            {{  $user->salary }}</td>
    @else
</div></td>
@endif

</div></td>
</tr>
<tr>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">سلفة</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->arrestreceipt->advance??"" }}</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p"> {{$items->arrestreceipt->description}}</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p"> {{ $items->arrestreceipt->advance??"" }}</div>
    </td>
</tr>
<tr>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">المتبقي</div>
    </td>
    @if(isset($user))
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{ $user->salary - $items->arrestreceipt->advance??""}}</div>
        </td>
    @else

    @endif
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
    </td>
    <td class="text-center align-middle p-1">
        <div class="bg-white rounded-2 p-1 min-h-40p"> {{$items->arrestreceipt->description}}</div>
    </td>

    @if(isset($user))
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p"> {{ $user->salary - $items->arrestreceipt->advance??""}}</div>
        </td>
    @else

    @endif
</tr>
<tr>
    <div class="row g-3">
        <td></td>
        <div class="col-2">
            <td class="text-center">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p d-flex justify-content-center align-items-center">
                    مجموع المدين
                </div>
            </td>
        </div>
        @if($items->arrestreceipt->type == "3")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->arrestreceipt->batch_quantity ??''}}"
                           disabled/></td>
            </div>
        @elseif($items->arrestreceipt->type == "4")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->arrestreceipt->batch_quantity ??''}}"
                           disabled/></td>
            </div>
        @elseif($items->arrestreceipt->type == "1")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->invoice->sub_total??'' }}" disabled/>
                </td>
            </div>

        @else
            @if(isset($items->invoicediscount))
                <div class="col-3">
                    <td><input class="form-control"
                               value=" {{ $items->invoice->sub_total??'' + $items->invoicediscount->discount_quantity??''}}"
                               disabled/></td>
                </div>
            @else

            @endif

        @endif


        <div class="col-2">
            <td class="text-center">
                <div class="bg-primary rounded-2 text-white p-1 min-h-40p d-flex justify-content-center align-items-center">
                    مجموع الدائن
                </div>
            </td>
        </div>
        @if($items->arrestreceipt->type == "3")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->arrestreceipt->batch_quantity ??''}}"
                           disabled/></td>
            </div>
        @elseif($items->arrestreceipt->type == "4")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->arrestreceipt->batch_quantity ??''}}"
                           disabled/></td>
            </div>
        @elseif($items->arrestreceipt->type == "1")
            <div class="col-3">
                <td><input class="form-control" value=" {{ $items->invoice->sub_total??'' }}" disabled/>
                </td>
            </div>

        @else
            @if(isset($items->invoicediscount))
                <div class="col-3">
                    <td><input class="form-control"
                               value=" {{ $items->invoice->sub_total??'' + $items->invoicediscount->discount_quantity??''}}"
                               disabled/></td>
                </div>
            @else

            @endif

        @endif
    </div>
</tr>
@else
    <tr>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}} </div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">
                @if($items->invoice->type == "1")
                    شراء
                @else
                    بيع
                @endif
            </div>
        </td>
        @if($items->invoice->type == "1")
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{ $items->invoice->sub_total + $items->invoicediscount->discount_quantity??''  }} </div>
            </td>
            <td class="text-center align-middle p-1"></td>
        @else
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
            @if(isset($items->invoicediscount))
                <td class="text-center align-middle p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p"> {{ $items->invoice->sub_total + $items->invoicediscount->discount_quantity??''  }}</div>
                </td>
                @else

                @endif

                </td>

            @endif
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->invoice->description}}</div>
            </td>
            @if(isset($items->invoicediscount))
                <td class="text-center align-middle p-1">
                    <div class="bg-white rounded-2 p-1 min-h-40p">
                        {{ $items->invoice->sub_total + $items->invoicediscount->discount_quantity??''  }}</div>
                </td>
            @else

            @endif

    </tr>
    <tr>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
        </td>
        @if($items->invoice->type == "1")
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">دفعة المورد</div>
            </td>
        @else
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">دفعة الزبون</div>
            </td>
        @endif

        @if($items->invoice->type == "1")
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->arrestreceipts->batch_quantity??"" }}</div>
            </td>
        @else
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->arrestreceipts->batch_quantity??"" }}</div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
        @endif

        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->invoice->description}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->arrestreceipts->batch_quantity??"" }}</div>
        </td>

    </tr>

    <tr>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">الخصم</div>
        </td>
        @if($items->invoice->type == "1")
            <td class="text-center align-middle p-1"></td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoicediscount->discount_quantity??''}}</div>
            </td>
        @else
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoicediscount->discount_quantity??''}}</div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
        @endif
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->invoice->description}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoicediscount->discount_quantity ??''}}</div>
        </td>
    </tr>

    <tr>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->id}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">
                <div class="bg-white rounded-2 p-1 min-h-40p">المتبقي</div>
        </td>
        @if($items->invoice->type == "1")
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoice->total_price  }}</div>
            </td>
        @else
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoice->total_price  }}</div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
            </td>
        @endif
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->invoice->description}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{ $items->invoice->total_price  }}</div>
        </td>
    </tr>
    <tr>
        <div class="row g-3">
            <td></td>
            <div class="col-2">
                <td>مجموع المدين</td>
            </div>
            <div class="col-3">
                <td><input class="form-control"
                           value=" {{ $items->invoice->sub_total??'' + $items->invoicediscount->discount_quantity??''}}"
                           disabled/></td>
            </div>

            <div class="col-2">
                <td class="text-center">
                    <div class="bg-primary rounded-2 text-white p-1 min-h-40p d-flex justify-content-center align-items-center">
                        مجموع الدائن
                    </div>
                </td>
            </div>

            <div class="col-3">
                <td><input class="form-control"
                           value=" {{ $items->invoice->total_price??'' + $items->invoicediscount->discount_quantity??'' + $items->arrestreceipts->batch_quantity??''}}"
                           disabled/></td>
            </div>
        </div>
    </tr>
@endif

@elseif($items->type == 2)
        <?php $payrollitem = App\Models\PayrollItem::where('payroll_id', $items->payroll->id)->get(); ?>
    @foreach($payrollitem as $payrollitems)
        <tr>

            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$items->payroll_id}} </div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p">
                    @if($items->type == 2)
                        كشوفات الرواتب
                    @endif </div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$payrollitems->paying_off}} </div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$payrollitems->advance}} </div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$payrollitems->user->name}} </div>
            </td>
            <td class="text-center align-middle p-1">
                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$payrollitems->advance}} </div>
            </td>

        </tr>
    @endforeach

@else
    <tr>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->user_id}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->user->name??''}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->debit_amount}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->credit_amount}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">{{$items->description}}</div>
        </td>
        <td class="text-center align-middle p-1">
            <div class="bg-white rounded-2 p-1 min-h-40p">-</div>
        </td>
    </tr>
    @endif
    </tbody>
    </table>

    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
            </div>{{ __('Empty limitations') }}</div>
        @endif
        </div>

        </div>