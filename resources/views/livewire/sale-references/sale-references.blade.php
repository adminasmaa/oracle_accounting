<div>

    <form class="row g-0 mb-4 justify-content-center form-export">
        <input type="hidden" name="type" value="{{request('type')}}">
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                من تاريخ
            </label>
            <input name="from" type="date" class="form-control" value="{{ $from }}">
        </div>
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                إلى تاريخ
            </label>
            <input name="to" type="date" class="form-control" value="{{ $to }}">
        </div>
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                الموردين
            </label>
            <select id="user_id-o" class="form-select" name="user_id">
                @if(request('type') == 3)
                    <option value="">كل الموردين</option>
                    @foreach($userssup as $user)
                        <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                @else
                    <option value="">كل الزبائن</option>
                    @foreach($userscust as $user)
                        <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                الفهارس
            </label>
            <select class="form-select" name="index_account_id">
                <option value="">كل الفهارس</option>
                @foreach($index_accounts as $index_account)
                    <option value="{{ $index_account->id }}"
                            {{ $index_account_id == $index_account->id ? 'selected' : '' }}>{{ $index_account->account_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                الحالات
            </label>
            <select class="form-select" name="status" wire:model.defer="status">
                <option value="">كل الحالات</option>
                @foreach(\App\Models\Invoice::statusList(false) as $key => $status)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-4 ps-1 mb-3">
            <label class="text-primary mb-2 fw-bold">
                الأنواع
            </label>
            <select class="form-select" name="type" wire:model.defer="type">
                <option value="">كل الأنواع</option>
                @foreach(\App\Models\Invoice::typeList(false) as $key => $type)
                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-5 ps-1 mb-2">
            <button wire:click="addinvoicereference({{request('type')?request('type'):0}})" type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#modalFormInvoice">
                @if(request('type')==2)
                    {{ __('Create invoice') }} مرجع بيع
                @else
                    انشاء فاتورة مرجع شراء
                @endif
            </button>
        </div>
        <div class="col-md-6 col-10 mb-2 ps-1">
            <label class="text-primary mb-2 fw-bold sr-only" for="search-o">
                بحث
            </label>
            <input id="search-o" name="search" placeholder="البحث بالرقم أو الوصف" type="text" class="form-control"
                   value="{{ $search }}">
        </div>
        <div class="col-md-1 col-2 mb-2 col-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100 mx-1"><i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </form>

    @if($invoices->count())
        <div class="row">
            <div class="table-responsive-sm pb-3">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الفاتورة</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الوصف</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تاريخ الفاتورة</div>
                        </th>
                        @if(request('type') == 3)
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم المورد</div>
                            </th>
                        @else
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الزبون</div>
                            </th>
                        @endif
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p"><a
                                            href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a></a>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">@if($invoice->description != null)
                                        <a
                                                href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->description }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">@if($invoice->invoice_date !=
                            null)
                                        {{ $invoice->invoice_date }}
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">@if($invoice->user)
                                        <a
                                                href="{{ route('users.show', ['user_id' => $invoice->user ? $invoice->user->id : '']) }}">{{ $invoice->user ? $invoice->user->name : '' }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            {{-- <td class="text-center align-middle p-1">@if($invoice->index_account)<a href="{{ route('index-accounts.show', ['index_account_id' => $invoice->index_account ? $invoice->index_account->id : '']) }}">{{ $invoice->index_account ? $invoice->index_account->account_name : '' }}</a>@else
                            - @endif</td> --}}
                            <!-- <td class="text-center align-middle p-1">{{ \App\Models\Invoice::statusList($invoice->status) }}
                            </td> -->
                            <!-- <td class="text-center align-middle p-1">{{ \App\Models\Invoice::typeList($invoice->type) }}</td> -->
                            {{-- <td class="text-center align-middle p-1">{{ $invoice->total_price }}</td> --}}
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">
                                    <livewire:invoices.invoice-edit :invoice_id="$invoice->id"
                                                                    :key="'invoice-edit-invoices-'.$invoice->id"></livewire:invoices.invoice-edit>
                                    <livewire:invoices.invoice-delete :invoice_id="$invoice->id"
                                                                      :key="'invoice-delete-invoices-'.$invoice->id"></livewire:invoices.invoice-delete>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $invoices->links() }}
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty invoices') }}
        </div>
    @endif


</div>