<div class="p-3">
    @if($arrest_receipt->type == 0)
        <h4 class="text-primary">ايصال القبض </h4>
    @elseif($arrest_receipt->type == 1)
        <h4 class="text-primary">سندات الصرف </h4>
    @endif
    <div class="row">
        <!-- @include("layouts.shared.msg") -->
        @if(session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="table-responsive-sm pb-3">
            <table class="table table-responsive-md table-borderless">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">التاريخ</div>
                    </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اختر</div>
                        </th>

                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الزبون</div>
                        </th>

                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الحساب</div>
                        </th>

                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الدفع</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center p-1 align-middle">
                        <div class="bg-white rounded-2 min-h-40p">
                            <div class="form-group">
                                <input wire:model="date" type="date"
                                       class="form-control text-center" placeholder="date" aria-label="Username"
                                       aria-describedby="addon-wrapping">
                            </div>
                            @error('date')<span class="text-danger error">{{ $message }}</span>@enderror </div>
                    </td>

                    <td class="text-center p-1 align-middle">
                        <div class="bg-white rounded-2 min-h-40p">
                            <select wire:model="client" name="client" class="form-select" required>
                                <option width="60px" value="">اختر النوع</option>
                                <option value="Supplier">التجار</option>
                                <option value="Employee">موظف</option>
                                <option value="acount">حسابات</option>
                                <option value="Customer">زبون</option>
                            </select>
                            <input wire:model.defer="{{$arrest_receipt->type}}" width="50px" type="hidden"
                                   name="arrestReceipttype" class="form-control" placeholder=""
                                   value="{{$arrest_receipt->type}}" disabled>
                            @error('client')<span class="text-danger error">{{ $message }}</span>@enderror

                        </div>
                    </td>

                    <td class="text-center p-1 align-middle">
                        <div class="bg-white rounded-2 min-h-40p">
                            <div class="form-group">
                                <div class="input-group flex-nowrap">
                                    <input required style="width: 120px" name="user"
                                           @if($user) value="{{$user->name}}" @endif
                                           type="text" class="form-control " placeholder="Username"
                                           aria-label="Username"
                                           aria-describedby="addon-wrapping">
                                    <span class="input-group-text btn-primary stretched-link pointer"
                                          data-bs-toggle="modal" href="#exampleModalToggle"
                                          id="addon-wrapping"><i class="fas fa-users "></i></span>
                                </div>
                                @error('user')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4 px-2">
                                            <div class="modal-header border-0">
                                                <span></span>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            @if ($arrest_receipt->type == 1)
                                                <h5 class="modal-title text-primary border-bottom pb-3"
                                                    id="exampleModalToggleLabel">التجار</h5>
                                            @else
                                                <h5 class="modal-title text-primary border-bottom pb-3"
                                                    id="exampleModalToggleLabel">الزبائن</h5>
                                            @endif

                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center text-primary p-1" scope="col">المستخدم
                                                        </th>
                                                        <th class="text-center text-primary p-1" scope="col">الرصيد</th>
                                                        <th class="text-center text-primary p-1" scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{$user->account_name}} {{$user->name}}</td>
                                                            <td>{{$user->total_price}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                        wire:click="selectUser({{$user->id}})">
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
                        </div>
                    </td>
                    <td class="text-center p-1 align-middle">
                        <div class="bg-white rounded-2 min-h-40p">
                            <div class="form-group">
                                <div class="input-group flex-nowrap">
                                    <input required style="width: 120px" name="user"
                                           @if($index_account) value="{{$index_account->account_name}}" @endif
                                           type="text" class="form-control " placeholder="Username"
                                           aria-label="Username"
                                           aria-describedby="addon-wrapping">
                                    <span class="input-group-text btn-primary stretched-link pointer"
                                          data-bs-toggle="modal" href="#exampleModalToggle2"
                                          id="addon-wrapping"><i class="fas fa-usd "></i></span>
                                </div>
                                @error('user')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
                                     aria-labelledby="exampleModalToggle2Label" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4 px-2">
                                            <div class="modal-header border-0">
                                                <span></span>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>

                                                <h5 class="modal-title text-primary border-bottom pb-3"
                                                    id="exampleModalToggle2Label">الحساب</h5>


                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center text-primary p-1" scope="col">الحساب
                                                        </th>
                                                        <th class="text-center text-primary p-1" scope="col">الرصيد</th>
                                                        <th class="text-center text-primary p-1" scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                    @foreach ($accounts as $account)
                                                        <tr>
                                                            <td>{{$account->account_name}} {{$account->name}}</td>
                                                            <td>{{$account->total_price}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                        wire:click="selectUser({{$account->id}})">
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
                        </div>
                    </td>
                    <td class="text-center p-1">
                        <div class="bg-white rounded-2 min-h-40p">
                            <div class="form-group">
                                <input wire:model="advance" type="text" class="form-control text-center" placeholder=""
                                       aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            @error('advance')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-12 text-end">
            <button type="button" wire:click="SaveUser({{$userSelect}})" class="btn btn-primary ">حفظ</button>
        </div>
    </div>
</div>