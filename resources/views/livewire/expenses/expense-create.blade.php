<div class="p-3">
    <h4 class="text-primary">فواتير المصاريف</h4>
    <div class="row">

        <!-- @include("layouts.shared.msg") -->
        @if(session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="row mb-5">
            <div class="col-md-4 col-6">
                <div class="form-group">
                    <label class="text-primary">رقم المورد</label>
                    <div class="input-group flex-nowrap">
                        <input required style="width: 120px" @if($users) value="{{$usernaemsup}}" @endif
                        type="text" class="form-control" placeholder=""
                               aria-label="Username" aria-describedby="addon-wrapping">
                        <span class="input-group-text pointer stretched-link bg-primary text-white"
                              data-bs-toggle="modal" href="#exampleModalToggle"
                              id="addon-wrapping"><i class="fas fa-users "></i></span>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 px-2">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-primary" scope="col">المستخدم</th>
                                        <th class="text-primary" scope="col">الرصيد</th>
                                        <th class="text-primary" scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->account_name}} {{$user->name}}</td>
                                            <td>{{$user->total_price}}</td>
                                            <td>
                                                <button class="btn btn-primary" type="button"
                                                        wire:click="selectUser({{$user->id}})">اختيار
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
            <div class="col-md-4 col-6">
                <div class="form-group">
                    <label class="text-primary">التاريخ</label>
                    <input wire:model.defer="expense.date" required type="date" class="form-control"/>
                    @error('expense.date') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="table-responsive-sm pb-3">
            <form wire:submit.prevent="store">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> رقم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> اسم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p"> المبلغ</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="200" class="text-center p-1">
                            <div class="form-group">
                                <div class="input-group flex-nowrap">

                                    <input required style="width: 120px"
                                           @if($users) value="{{$useraccount->account_number??''}}" @endif type="text"
                                           class="form-control" placeholder="" aria-label="Username"
                                           aria-describedby="addon-wrapping">

                                    <span class="input-group-text btn-primary stretched-link pointer"
                                          data-bs-toggle="modal" href="#exampleModalToggleAcount"
                                          id="addon-wrapping"><i class="fas fa-users "></i></span>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalToggleAcount" aria-hidden="true"
                                 aria-labelledby="exampleModalToggleLabel"
                                 tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 px-3">
                                        <div class="modal-header border-0">
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
                                                    <th class="text-primary" scope="col">الرصيد</th>
                                                    <th class="text-primary" scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                @foreach ($indexaccount as $user)
                                                    <tr>
                                                        <td>{{$user->account_number}}</td>
                                                        <td>{{$user->account_name}} {{$user->name}}</td>
                                                        <td>{{$user->total_price}}</td>
                                                        <td>
                                                            <button class="btn btn-primary " type="button"
                                                                    wire:click="selectAccount({{$user->id}})">اختيار
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
                        <td class="text-center p-1"><input value="{{$useraccount->account_name??''}}" width="20"
                                                           type="text" class="form-control"/></td>
                        <td class="text-center p-1"><input wire:model.defer="expense.batch_quantity" width="20"
                                                           type="number" class="form-control"/>
                            @error('expense.batch_quantity') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button wire:loading.attr="disabled" type="submit" class="btn btn-primary w-25" data-bs-dismiss="modal">
                    حفظ
                </button>
            </form>
        </div>
    </div>
</div>