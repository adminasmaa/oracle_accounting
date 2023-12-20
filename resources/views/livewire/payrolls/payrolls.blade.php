<div>
    <div class="row">
        <div class="col-md-5">
            <button wire:click="addpayroll" type="button" class="btn btn-primary mb-3"
                    data-bs-toggle="modal" data-bs-target="#modalFormaddpayroll">
                انشاء كشف رواتب
            </button>
        </div>


        <div class="row">
            <div class="table-responsive-sm pb-3">
                @if($payrolls->count())
                    <table class="table table-responsive-md table-borderless">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">التاريخ</div>
                            </th>
                            <!-- <th scope="col" class="text-center p-1">الراتب</th> -->
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الدفع</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $advance = 0 ?>
                        @foreach($payrolls as $payroll)
                            <tr>
                                <td class="text-center p-1 align-middle">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                                </td>
                                <td class="text-center p-1 align-middle">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $payroll->date }}</div>
                                </td>
                                <td class="text-center p-1 align-middle">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $payroll->payroll_items->sum('paying_off') }}</div>
                                </td>

                                <!-- <td class="text-center p-1 align-middle">@if($payroll->user)
                                    <a href="{{ route('users.show', ['user_id' => $payroll->user ? $payroll->user->id : '']) }}">{{ $payroll->user ? $payroll->user->name : '' }}</a>
                                @else
                                    -
                                @endif</td>
                                <td class="text-center p-1 align-middle">@if($payroll->user)
                                    {{ $payroll->user ? $payroll->user->balance : '' }}
                                @else
                                    -
                                @endif</td> -->
                                <!-- <td class="text-center p-1 align-middle"><a href="{{ route('payrolls.show', ['payroll_id' => $payroll->id]) }}">{{ $payroll->advance }}</a></td> -->
                                <td class="text-center p-1 align-middle">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">
                                        <a type="button" class="btn btn-sm text-success border-start "
                                           href="{{route('payrolls.show',$payroll->id)}}" title="عرض"> <i
                                                    class="fa fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm border-end"
                                           href="{{route('payroll-items.edit',$payroll->id)}}" title="تعديل"> <i
                                                    class="fa fa-edit"></i></a>
                                        <livewire:payrolls.payroll-delete :payroll_id="$payroll->id"
                                                                          :key="'payroll-delete-payrolls-'.$payroll->id"></livewire:payrolls.payroll-delete>
                                    </div>
                                </td>
                            </tr>
                                <?php $advance = $advance + $payroll->advance ?>
                        @endforeach

                        </tbody>
                        {{ $payrolls->links() }}
                    </table>
                @else
                    <div class="mb-3 text-center fs-4 py-3">
                        <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                        </div>{{ __('Empty payrolls') }}</div>
                @endif
            </div>

        </div>
    </div>
</div>

