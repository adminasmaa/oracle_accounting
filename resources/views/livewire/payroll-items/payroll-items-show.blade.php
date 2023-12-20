<div>
    <div class="row">
        <div class="col-md-5">
            <button wire:click="addpayroll" type="button" class="btn btn-primary mb-3"
                    data-bs-toggle="modal" data-bs-target="#modalFormaddpayroll">
                انشاء كشف رواتب
            </button>
        </div>

        @if($payrolls->count())
            <div class="row">
                <div class="table-responsive-sm pb-3">
                    <table class="table table-responsive-md table-borderless">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الموظف</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">السلف</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المبلغ</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $advance = 0;
                            $paying_off = 0; ?>
                        @foreach($payrolls as $payroll)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $payroll->user->name??''  }}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 p-1 min-h-40p"><a
                                                href="{{ route('payrolls.show', ['payroll_id' => $payroll->id]) }}">{{ $payroll->advance }}</a>
                                    </div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $payroll->paying_off  }}</div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">
                                        <livewire:payroll-items.payroll-item-delete :payroll_id="$payroll->id"
                                                                                    :key="'payroll-item-delete-payroll-items-'.$payroll->id"></livewire:payroll-items.payroll-item-delete>
                                    </div>
                                </td>
                            </tr>
                                <?php $advance = $advance + $payroll->advance;
                                $paying_off = $paying_off + $payroll->paying_off
                                ?>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-center align-middle p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p fw-bold">المجموع</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $advance }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{$paying_off}}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="mb-3 text-center fs-4 py-3">
                <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                </div>{{ __('Empty payrolls') }}</div>
        @endif
    </div>

