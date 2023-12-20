<div>
    <h4 class="text-primary">الايرادات</h4>

    <a type="button" class="btn btn-primary" href="{{route('revenues.create')}}" title="عرض"> + اضف </a>
    @if($arrestreceipts->count())

        <div class="row mt-3">
            <div class="table-responsive-sm pb-3">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب أو المورد</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المبلغ</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">وصف بسيط</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $batch_quantity = 0; ?>
                    @foreach($arrestreceipts as $arrestreceipt)
                        <tr>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }} </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{$arrestreceipt->user->name??''}} {{$arrestreceipt->indexaccount->account_name??''}}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$arrestreceipt->batch_quantity}}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p"> {{$arrestreceipt->description}}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">
                                    <livewire:expenses.expense-edit :arrest_receipt_id="$arrestreceipt->id"
                                                                    :key="'expense-edit-expenses-'.$arrestreceipt->id"></livewire:expenses.expense-edit>
                                    <livewire:expenses.expense-delete :arrest_receipt_id="$arrestreceipt->id"
                                                                      :key="'expense-delete-expenses-'.$arrestreceipt->id"></livewire:expenses.expense-delete>
                                </div>
                            </td>

                        </tr>
                            <?php $batch_quantity = $batch_quantity + $arrestreceipt->batch_quantity; ?>
                    @endforeach
                    <tr>
                        <th colspan="3" scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المجموع</div>
                        </th>
                        <th colspan="2" scope="col" class="text-center p-1">
                            <div class="bg-white rounded-2 p-1 min-h-40p">{{$batch_quantity}} </div>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty revenues') }}
        </div>
    @endif


</div>

