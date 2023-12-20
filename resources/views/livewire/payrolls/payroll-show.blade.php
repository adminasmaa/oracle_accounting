<div class="d-inline">
    <h4 class="p-3 text-primary">كشوفات الرواتب</h4>
    <form wire:submit.prevent="addpayrolls" class="modal-body">
        <div class="text-center p-3">
            <div class="row">
                <div class="table-responsive-sm pb-3">
                    <table class="table table-responsive-md table-borderless">
                        <thead>
                        <tr>
                            <th class="p-1" scope="col">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تاريخ</div>
                            </th>
                            <th class="p-1" scope="col">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الوصف</div>
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center px-1">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    <div class="position-relative">
                                        <input type="date" value="{{$payroll['date']}}" wire:model="payroll.date"
                                               class="form-control border-0">
                                    </div>
                                </div>
                                @error('payroll.date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </td>
                            <td class="text-center px-1">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    <input type="text" wire:model="payroll.description"
                                           class="form-control border-0">
                                    @error('payroll.description') <span
                                            class="text-danger error">{{ $message }}</span>@enderror

                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row g-2 px-md-4">
            <div class="form-group col-md-3 col-6">
                <label class="text-primary" for="">الموظف</label>
            </div>

            <div class="form-group col-md-3 col-6 ">
                <label class="text-primary" for="">الراتب</label>
            </div>

            <div class="form-group col-md-2 col-6">
                <label class="text-primary" for="">السلف</label>
            </div>

            <div class="form-group col-md-3 col-6">
                <label class="text-primary" for="">الدفع</label>
            </div>


            <div class="col-md-1 text-center align-self-end">

            </div>
        </div>

        @foreach($payroll_items as $key => $employee)
            <div class="row g-2 px-md-4 mt-2">
                <div class="form-group col-md-3 col-6">
                    <td wire:ignore.self width="200" class="text-center ">
                        <div wire:ignore.self class="form-group">
                            <div wire:ignore.self class="input-group flex-nowrap">
                                <input wire:ignore.self style="width: 120px" disabled value="{{$name_payroll[$key]}}"
                                       type="text"
                                       class="form-control " placeholder=""
                                       aria-label="Username">
                                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                                      href="#exampleModalToggleAcount{{$key}}"><i
                                            class="fas fa-users "></i></span>
                            </div>
                        </div>
                        <div wire:ignore.self class="modal fade" id="exampleModalToggleAcount{{$key}}"
                             aria-hidden="true"
                             aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content rounded-4 px-2">
                                    <div class="modal-header">
                                        <span></span>
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-primary" scope="col">رقم الحساب</th>
                                                <th class="text-primary" scope="col">المستخدم</th>
                                                <th colspan="2" class="text-primary" scope="col">الرصيد</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            @foreach ($users as $key2 => $user)
                                                <tr>
                                                    <td>{{$user->account_number}} {{$user->id}}</td>
                                                    <td>{{$user->account_name}} {{$user->name}}</td>
                                                    <td>{{$user->total_price}}</td>
                                                    <td>
                                                             <button class="btn btn-primary" type="button"
                                                                    wire:click="selectUser({{$key}},{{$user->id}})">
                                                                اختيار
                                                            </button>
                                                     </td>
                                                </tr>
                                                @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @error('payroll_items.{{$key}}.user_id') <span
                            class="text-danger error">{{ $message }}</span>@enderror

                </div>

                <div class="form-group col-md-3 col-6 ">
                    <input value="{{$payroll_items[$key]['salary']}}" placeholder="الراتب" type="text"
                           class="form-control" disabled>
                </div>

                <div class="form-group col-md-2 col-6">
                    <input wire:model="payroll_items.{{$key}}.advance" type="number" class="form-control" disabled>
                    @error('payroll_items.{{$key}}.advance')<span
                            class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-3 col-6">
                    <input value="{{$payroll_items[$key]['paying_off']}}" wire:model="payroll_items.{{$key}}.paying_off"
                           type="number" class="form-control">
                    @error('payroll_items.{{$key}}.paying_off')<span
                            class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-1 text-center align-self-end">
                    @if($key == (count($payroll_items)-1))
                    <button wire:loading.attr="disabled" type="button" wire:click="AddEmployee()"
                            style="background-color: #478fcc;color:white"
                            class="btn">{{ __('Add') }}</button>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="row mt-5">
            <div class="col">
                <button wire:loading.attr="disabled" type="submit" style="background-color: #478fcc;color:white"
                        class="btn ms-3">{{ __('Save') }}</button>

            </div>
            <div class="col">
            </div>
            <div class="col"></div>
        </div>

    </form>
</div>