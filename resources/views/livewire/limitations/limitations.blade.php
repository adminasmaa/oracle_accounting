<div>
    <div class="px-1">
        <!-- <button wire:click="addpayroll" type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
            data-bs-target="#modalFormaddpayroll">
            انشاء قيود
        </button> -->
        <h4 class="text-primary d-inline-block ps-4"> القيود </h4>

        <a type="button" class="btn btn-primary mb-3" href="{{route('limitations.create')}}" title="عرض"> + اضف </a>

    </div>


    <div class="row">
        <div class="table-responsive-sm pb-3">
            @if($items->count())
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">التاريخ القيد</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> الساعة</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">مبلغ القيد</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">بيان القيد الاجمالي</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $payroll)

                            <tr>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">{{ $loop->iteration }}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">{{$payroll->date}}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"></div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"></div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">{{$payroll->description}}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">
                                        <a href="{{route('limitations.show',$payroll->id)}}"
                                           class="btn btn-sm text-success "
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                           data-kt-menu-flip="top-end"><i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                    @endforeach
                    <tr>

                    </tbody>
                </table>
            @else
                <div class="mb-3 text-center fs-4 py-3">
                    <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                    </div>{{ __('Empty limitations') }}</div>
            @endif
        </div>
    </div>

</div>