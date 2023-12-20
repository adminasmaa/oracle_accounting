<div class="text-center p-3">
    <div class="row">
        @if($invoice->type == 2)
            <h3>انشاء مرجع بيع </h3>
        @elseif($invoice->type == 3)
            <h3 class="text-start text-primary mb-3">انشاء مرجع شراء</h3>
        @endif
        <!-- @include("layouts.shared.msg") -->
        <div class="table-responsive-sm pb-3">
            <table class="table table-responsive-md table-borderless">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الفاتورة</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تاريخ الفاتورة</div>
                    </th>
                    @if($invoice->type == 3)
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم المورد</div>
                        </th>
                    @elseif($invoice->type == 2)
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الزبون</div>
                        </th>
                    @endif
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الوصف</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="40" class="text-center ">
                        <div class="bg-white rounded-2 p-1 min-h-40p">
                            <a href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a>
                        </div>
                    </td>
                    <td width="50px" class="text-center ">
                        <div class="position-relative">
                            <div class="bg-white rounded-2 p-1 min-h-40p">
                                <div class="form-group position-relative">
                                    <input type="date" wire:model="date" class="form-control border-0 ">

                                </div>
                            </div>
                            @error('date') <span
                                    class="text-danger position-absolute error">{{ $message }}</span>@enderror
                        </div>
                    </td>
                    <td width="50px" class="text-center ">
                        <div class="position-relative">
                            <div class="bg-white rounded-2 p-1 min-h-40p">
                                <div class="input-group flex-nowrap">
                                    <input style="width: 120px" name="user" @if($user) value="{{$user->name}}" @endif
                                    type="text" class="form-control border-0" placeholder="Username"
                                           aria-label="Username"
                                           aria-describedby="addon-wrapping">
                                    <a class="input-group-text btn-primary stretched-link" data-bs-toggle="modal"
                                       href="#exampleModalToggle"
                                       id="addon-wrapping"><i class="fas fa-users "></i></a>
                                </div>
                            </div>
                            @error('user') <span
                                    class="text-danger position-absolute error">{{ $message }}</span>@enderror
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
                                        @if ($invoice->type == 2)
                                            <h5 class="modal-title text-primary pb-3" id="exampleModalToggleLabel">
                                                التجار</h5>
                                        @else
                                            <h5 class="modal-title text-primary pb-3" id="exampleModalToggleLabel">
                                                الزبائن</h5>
                                        @endif

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
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->total_price}}</td>
                                                        <td>
                                                            <button class="btn btn-primary" type="button"
                                                                    wire:click="selectUser({{$user->id}})">اختيار
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
                    <td width="250px" class="text-center ">
                        <!-- <div class="form-group col-2"> -->
                        <textarea wire:model.defer="invoice_item.description" rows="1"
                                  class="form-control"></textarea>
                        @error('invoice_item.description')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                        <!-- </div> -->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- {{$invoice->id}} -->
        <form wire:submit.prevent="store" class="modal-body">
            <div class="row g-0">

                <div class="form-group text-start col ps-1">
                    <label for="">السيريل</label>
                    <input wire:model="serial" placeholder="ادخل السيريل" type="text" class="form-control">
                </div>
                <div class="form-group text-start col ps-1">
                    <label for="">الصنف</label>
                    <select wire:model="invoice_item.item_id" name="item_id" class="form-select">
                        <option value="">{{ __('Nothing') }}</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('invoice_item.item_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <!-- @dump($invoice->type); -->
                @if($invoice->type == 3)
                    <div class="form-group text-start col ps-1">
                        <label for="">وحدة الشراء</label>
                        <select wire:model="invoice_item.unit_id" name="unit_id" class="form-select">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($units as $item)
                                <option value="{{ $item->id }}">{{ $item->unit->name }}</option>
                            @endforeach
                        </select>
                        @error('invoice_item.unit_id')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group text-start col ps-1">
                        <label for="">سعر الشراء</label>
                        <input wire:model.defer="invoice_item.purchasing_price" type="" class="form-control">
                        @error('invoice_item.purchasing_price')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                @elseif($invoice->type == 2)
                    <div class="form-group text-start col ps-1">
                        <label for="">وحدة البيع</label>
                        <select wire:model="invoice_item.unit_id" name="unit_id" class="form-select">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($units as $item)
                                <option value="{{ $item->id }}">{{ $item->unit->name }}</option>
                            @endforeach
                        </select>
                        @error('invoice_item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group text-start col ps-1">
                        <label for="">سعر البيع</label>
                        <input wire:model.defer="invoice_item.selling_price" type="number" class="form-control">
                        @error('invoice_item.selling_price')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                @else

                @endif
                <div class="form-group text-start col ps-1">
                    <label for="">الكمية</label>
                    <input wire:model.defer="invoice_item.quantity" type="number" class="form-control">
                    @error('invoice_item.quantity')<span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @if($invoice->type == 3)
                    <div class="form-group text-start col ps-1">
                        <label for="">اجمالي</label>
                        <input wire:model.defer="invoice_item.total_price_quantity" type="number" class="form-control">
                        @error('invoice_item.total_price_quantity')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                @else
                    <div class="form-group text-start col ps-1">
                        <label for="">اجمالي</label>
                        <input wire:model.defer="invoice_item.total_selling_price_quantity" type="number"
                               class="form-control">
                        @error('invoice_item.total_selling_price_quantity')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                @endif

                <div class="form-group col-1 ps-1 align-self-end">
                    <button wire:loading.attr="disabled" type="submit" style="background-color: #478fcc;color:white"
                            class="btn w-100">{{ __('Add') }}</button>
                </div>
            </div>
        </form>

    </div>

    <livewire:sale-references.sale-reference-edit :invoice_id="$invoice->id"
                                                  :key="'sale-reference-edit-sale-references-'"></livewire:sale-references.sale-reference-edit>
</div>