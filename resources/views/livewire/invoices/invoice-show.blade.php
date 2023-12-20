<div class="text-center p-3">
    <div class="row">
        @if($invoice->type == 1)
            <h3 class="text-primary text-start mb-3">انشاء فاتوره شراء</h3>
        @elseif($invoice->type == 0)
            <h3 class="text-primary text-start mb-3">انشاء فاتوره بيع</h3>
        @endif
        <div class="table-responsive-sm pb-3">
            <table class="table table-responsive-md table-borderless">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p">رقم الفاتورة</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p">تاريخ الفاتورة</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p">اختر</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p"> -</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p">الحساب</div>
                    </th>

                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white min-h-40p">الوصف</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="80px" class="text-center p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p"><a
                                    href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a>
                        </div>
                    </td>
                    <td width="20px" class="text-center p-1">
                        <div class="rounded-2 min-h-40p">
                            <div class="form-group col">
                                <input type="date" wire:model="date" class="form-control">
                            </div>
                        </div>
                    </td>
                    <td width="130px" class="text-center p-1">
                        <div class="rounded-2 min-h-40p">
                            <select wire:model="client" name="client" class="form-select" required>
                                <option value="">اختر النوع</option>
                                <option value="Customer">الزبون</option>
                                <option value="Employee">موظف</option>
                                <option value="Supplier">مورد</option>
                            </select>
                        </div>
                    </td>
                    <td width="100px" class="text-center p-1">
                        <div class="rounded-2 min-h-40p">
                            <div class="form-group">
                                <div class="input-group flex-nowrap">
                                    @if($this->client == "acount")
                                        <input required style="width: 120px" @if($user)
                                            value="{{$this->useraccount}}" @endif type="text"
                                               class="form-control rounded"
                                               placeholder="{{$this->useraccount}}" aria-label="Username"
                                               aria-describedby="addon-wrapping">
                                    @else
                                        <input required style="width: 120px" @if($user) value="{{$user->name}}" @endif
                                        type="text" class="form-control" placeholder="Username" aria-label="Username"
                                               aria-describedby="addon-wrapping">
                                    @endif
                                    <span class="input-group-text btn-primary stretched-link pointer"
                                          data-bs-toggle="modal" href="#exampleModalToggle"
                                          id="addon-wrapping"><i class="fas fa-users "></i></span>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                 aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 px-2">
                                        <div class="modal-header">
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-responsive-md table-borderless">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">
                                                        <div class="d-flex">
                                                            <input class="form-control" wire:model="search" type="text">
                                                            <span class="btn btn-primary rounded mx-1"><i
                                                                        class="fa-solid fa-magnifying-glass"></i> </span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">
                                                            المستخدم
                                                        </div>
                                                    </th>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">الرصيد
                                                        </div>
                                                    </th>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">-</div>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="text-center p-1">
                                                @if($this->client == "acount")
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$user->account_name}} {{$user->name}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$user->total_price}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <button class="btn btn-primary rounded w-100"
                                                                        type="button"
                                                                        wire:click="selectUser({{$user->id}})">اختيار
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$user->account_name}} {{$user->name}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$user->total_price}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <button class="btn btn-primary rounded w-100"
                                                                        type="button"
                                                                        wire:click="selectUser({{$user->id}})">اختيار
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td width="100px" class="text-center p-1">
                        <div class="rounded-2 min-h-40p">
                            <div class="form-group">
                                <div class="input-group flex-nowrap">
                                    <input required style="width: 120px" @if($index_account) value="{{$index_account->account_name}}" @endif
                                    type="text" class="form-control" placeholder="Account name" aria-label="Account name"
                                           aria-describedby="addon-wrapping">
                                    <span class="input-group-text btn-primary stretched-link pointer"
                                          data-bs-toggle="modal" href="#exampleModalToggle3"
                                          id="addon-wrapping"><i class="fas fa-usd"></i></span>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="exampleModalToggle3" aria-hidden="true"
                                 aria-labelledby="exampleModalToggle3Label" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 px-2">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-responsive-md table-borderless">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">
                                                        <div class="d-flex">
                                                            <input class="form-control" wire:model="search" type="text">
                                                            <span class="btn btn-primary rounded mx-1"><i
                                                                        class="fa-solid fa-magnifying-glass"></i> </span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">
                                                            المستخدم
                                                        </div>
                                                    </th>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">الرصيد
                                                        </div>
                                                    </th>
                                                    <th class="text-center p-1" scope="col">
                                                        <div class="bg-primary rounded-2 text-white min-h-40p">-</div>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="text-center p-1">
                                                    @foreach ($accounts as $account)
                                                        <tr>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$account->account_name}} {{$account->name}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$account->total_price}}</div>
                                                            </td>
                                                            <td class="text-center p-1">
                                                                <button class="btn btn-primary rounded w-100"
                                                                        type="button"
                                                                        wire:click="selectAccount({{$account->id}})">اختيار
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td width="280px" class="text-center p-1">
                        <div class="rounded-2 min-h-40p">
                            <!-- <div class="form-group col-2"> -->
                            <textarea wire:model="description" wire:change="updateDescription" rows="1"
                                      class="form-control"></textarea>
                            @error('description')<span class="text-danger error">{{ $message }}</span>@enderror
                            <!-- </div> -->
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <livewire:invoice-items.invoice-items :invoice_id="$invoice->id"
                                              :key="'invoice-items-invoice-show-'. $invoice->id"></livewire:invoice-items.invoice-items>

        {{-- <livewire:arrest-receipts.arrest-receipts :invoice_id="$invoice->id" :key="'arrest-receipts-invoice-show-'. $invoice->id"></livewire:arrest-receipts.arrest-receipts> --}}
    </div>
</div>