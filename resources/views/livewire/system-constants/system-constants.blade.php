<div class="">

    <form wire:submit.prevent="update" class="modal-body row g-2">
        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب الصندوق </label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required
                       value="{{$inbox_account_account->account_name}} ({{$inbox_account_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalToggleAccountindex"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalToggleAccountindex" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectAccountindex({{$account->id}})">اختيار
                                                </button>
                                            </div>
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

            @error('setting.inbox_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب المبيعات</label>
            <div class="form-group">
                <div class="input-group flex-nowrap">
                    <!-- {{$payment_selling_account }} -->
                    <input type="hidden" wire:model.defer="setting.id"/>
                    <!-- {{$payment_selling_account}} -->
                    <input required
                           value="{{$payment_selling_account->account_name}} ({{$payment_selling_account->total_price}})"
                           disabled
                           type="text" class="form-control bg-white" placeholder="Account name">
                    <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                          href="#exampleModalToggleAcount"
                          id="addon-wrapping"><i class="fas fa-users "></i></span>
                </div>
            </div>
            <div class="modal fade" id="exampleModalToggleAcount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectAccount({{$account->id}})">اختيار
                                                </button>
                                            </div>
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

            @error('setting.payment_selling_account_index_id') <span
                    class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب المشتريات</label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required
                       value="{{$payment_parchasing_account->account_name}} ({{$payment_parchasing_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalToggleparchasingAcount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalToggleparchasingAcount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectAccountparchasing({{$account->id}})">اختيار
                                                </button>
                                            </div>
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

            @error('setting.payment_parchasing_account_index_id') <span
                    class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب الموظفين</label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required value="{{$salary_account->account_name}} ({{$salary_account->total_price}})" disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalTogglesalaryaccount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalTogglesalaryaccount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectsalaryaccount({{$account->id}})">اختيار
                                                </button>
                                            </div>
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
            @error('setting.salary_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب الزبائن</label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required value="{{$customers_account->account_name}} ({{$customers_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalTogglecustomersaccount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalTogglecustomersaccount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectcustomersaccount({{$account->id}})">اختيار
                                                </button>
                                            </div>
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

            @error('setting.customers_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">حساب الموردين</label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required value="{{$suppliers_account->account_name}} ({{$suppliers_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalToggleSuppliersAccount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalToggleSuppliersAccount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectsuppliersaccount({{$account->id}})">اختيار
                                                </button>
                                            </div>
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

            @error('setting.suppliers_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">الخصم المكتسب </label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required
                       value="{{$discount_earned_account->account_name}} ({{$discount_earned_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalTogglediscountearnedaccount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalTogglediscountearnedaccount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectdiscountearnedaccount({{$account->id}})">
                                                    اختيار
                                                </button>
                                            </div>
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

            @error('setting.discount_earned_account_index_id') <span
                    class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-6 mt-3">
            <label class="text-primary" for="">الخصم المسموح بة</label>
            <div class="input-group flex-nowrap">
                <input type="hidden" wire:model.defer="setting.id"/>
                <input required
                       value="{{$allowed_discount_account->account_name}} ({{$allowed_discount_account->total_price}})"
                       disabled
                       type="text" class="form-control bg-white" placeholder="Account name">
                <span class="input-group-text btn-primary stretched-link pointer" data-bs-toggle="modal"
                      href="#exampleModalTogglediscountaccount"
                      id="addon-wrapping"><i class="fas fa-users "></i></span>
            </div>

            <div class="modal fade" id="exampleModalTogglediscountaccount" aria-hidden="true"
                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 px-2">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">المستخدم</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                                    </th>
                                    <th class="text-center p-1 border-0" scope="col">
                                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($index_accounts as $account)
                                    <tr>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_number}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->account_name}} </div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">{{$account->total_price}}</div>
                                        </td>
                                        <td class="text-center p-1 border-0">
                                            <div class="bg-light rounded-2 p-1 min-h-40p">
                                                <button class="btn btn-primary w-100" type="button"
                                                        wire:click="selectalloweddiscountaccount({{$account->id}})">
                                                    اختيار
                                                </button>
                                            </div>
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

            @error('setting.allowed_discount_account_index_id') <span
                    class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="col-12 align-self-end text-center mt-3">
            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary w-25">{{ __('Save') }}</button>
        </div>
    </form>

</div>