<div class="p-3">
    <h4 class="text-primary fw-bold">القيود</h4>
    <div class="row">
        <!-- @include("layouts.shared.msg") -->
        @if(session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="row mb-5">
            <div class="col-md-4 col-6">
                <label class="mb-2 text-primary">التاريخ</label>
                <input wire:model.defer="limitation.date" type="date" class="form-control"/>
                @error('limitation.date')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="col-md-4 col-6">
                <label class="mb-2 text-primary">الوصف</label>
                <input wire:model.defer="limitation.description" required type="text" class="form-control"/>
            </div>
        </div>
        <div class="table-responsive-sm pb-3">
            <form wire:submit.prevent="store">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> اختر</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> رقم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> اسم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> المبلغ المدين</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المبلغ الدائن</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($Limitation as $key => $value)

                        <tr wire:ignore.self>
                            <td width="130px" class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">
                                    <select wire:ignore.self wire:model="Limitation.{{$key}}.limitType"
                                            wire:change="codeSelected({{$key}})" class="form-select"  required>
                                        <option value="">اختر النوع</option>
                                        <option value="Supplier">التجار</option>
                                        <option value="Employee">الموظف</option>
                                        <option value="acount">الحسابات</option>
                                        <option value="Customer">الزبون</option>
                                    </select>
                                    <input wire:model.defer="" width="50px" type="hidden"
                                           name="arrestReceipttype" class="form-control" placeholder=""
                                           value="" disabled>
                                </div>
                            </td>
                            <td wire:ignore.self width="200" class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">
                                    <div wire:ignore.self class="form-group">
                                        <div wire:ignore.self class="input-group flex-nowrap">
                                            @if($this->Limitation[$key]['limitType'] == "acount")
                                                <!-- <input wire:ignore.self style="width: 120px" wire:model="Limitation.{{$key}}.index_account_id" type="text"
                                        class="form-control" placeholder="" aria-label="Username"
                                        aria-describedby="addon-wrapping"> -->
                                                <input wire:ignore.self style="width: 120px"
                                                       wire:model="Limitation.{{$key}}.account_number"
                                                       value="$this->Limitation[$key]['account_number']" type="text"
                                                       class="form-control" placeholder="" aria-label="Username"
                                                       aria-describedby="addon-wrapping">
                                            @else
                                                <input wire:ignore.self style="width: 120px"
                                                       wire:model="Limitation.{{$key}}.id" type="text"
                                                       wire:change="numberSelected({{$key}})"
                                                       class="form-control " placeholder="" aria-label="Username"
                                                       aria-describedby="addon-wrapping">
                                            @endif
                                            <span class="input-group-text btn-primary stretched-link pointer"
                                                  data-bs-toggle="modal" href="#exampleModalToggleAcount{{$key}}"
                                                  id="addon-wrapping"><i class="fas fa-users "></i></span>
                                        </div>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="exampleModalToggleAcount{{$key}}"
                                         aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                                         tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4 px-2">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-primary" scope="col">رقم الحساب</th>
                                                            <th class="text-primary" scope="col">المستخدم</th>
                                                            <th class="text-primary" scope="col">الرصيد</th>
                                                            <th class="text-primary" scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td>{{$user->account_number}} {{$user->id}}</td>
                                                                <td>{{$user->account_name}} {{$user->name}}</td>
                                                                <td>{{$user->total_price}}</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary"
                                                                            wire:model="Limitation.{{$key}}.limitType"
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
                                </div>
                            </td>
                            @if($this->Limitation[$key]['limitType'] == "acount")
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.account_name"
                                                wire:change="nameSelected({{$key}})" width="20" type="text"
                                                class="form-control"/></div>
                                </td>
                            @else
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.name"
                                                wire:change="nameSelected({{$key}})" width="20" type="text"
                                                class="form-control"/></div>
                                </td>
                            @endif
                            @if(!$this->Limitation[$key]['debit_amount'] == "" )
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.debit_amount"
                                                wire:change="debitSelected({{$key}})" width="20" type="number"
                                                class="form-control"/></div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.credit_amount"
                                                wire:change="creditSelected({{$key}})" width="20" type="number"
                                                class="form-control" disabled/></div>
                                </td>
                            @elseif(!$this->Limitation[$key]['credit_amount'] == "" )
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.debit_amount"
                                                wire:change="debitSelected({{$key}})" width="20" type="number"
                                                class="form-control" disabled/></div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.credit_amount"
                                                wire:change="creditSelected({{$key}})" width="20" type="number"
                                                class="form-control"/></div>
                                </td>
                            @else
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.debit_amount"
                                                wire:change="debitSelected({{$key}})" width="20" type="number"
                                                class="form-control"/></div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p"><input
                                                wire:model="Limitation.{{$key}}.credit_amount"
                                                wire:change="creditSelected({{$key}})" width="20" type="number"
                                                class="form-control"/></div>
                                </td>
                            @endif
                            <td>
                                <button wire:click.prevent="removeLimitationnumber({{$key}})" type="button"
                                        class="btn btn-danger w-100">حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>

                    <td colspan="2" class="text-center align-middle p-1 fw-bold">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> المجموع المدين</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 py-1 min-h-40p">{{$limidebit}}</div>
                    </td>
                    <td class="text-center align-middle fw-bold p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المجموع الدائن</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="shadow-sm rounded-2 py-2 min-h-40p"> {{$limicredit}}</div>
                    </td>
                    <td>
                        <button wire:ignore.self wire:click.prevent="addLimitationnumber()" type="button"
                                class="btn btn-primary w-100">اضف
                        </button>
                    </td>

                </table>
                <button wire:loading.attr="disabled" type="submit" class="btn btn-primary" data-bs-dismiss="modal">حفظ
                </button>
            </form>
        </div>
    </div>
</div>