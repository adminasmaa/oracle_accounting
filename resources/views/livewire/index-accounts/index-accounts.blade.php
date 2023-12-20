<div>
    <div class="row mb-3">
        <div class="col-md-3">
            <livewire:index-accounts.index-account-create
                    :key="'index-account-create-index-accounts-'"></livewire:index-accounts.index-account-create>
        </div>
        <div class="col-md-9 text-start">
            <form class="row g-1 justify-content-end">
                <div class="col-md-3 col-6">
                    <input name="search" placeholder="البحث بالرقم أو الاسم" type="text" class="form-control"
                           value="{{ $search }}">
                </div>
                <div class="col-md-3 col-6">
                    <select class="form-select" name="index_account_id">
                        <option value="">كل التوابع</option>
                        @foreach($index_accounts_filter as $index_account)
                            <option value="{{ $index_account->id }}" {{ $index_account_id == $index_account->id ? 'selected' : '' }}>{{ $index_account->account_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-5">
                    <select class="form-select" name="basic" wire:model.defer="basic">
                        <option value="">كل الأساسي</option>
                        @foreach(\App\Models\IndexAccount::basicList(false) as $key => $basic)
                            <option value="{{ $key }}" {{ request('basic') == $key ? 'selected' : '' }}>{{ $basic }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-5">
                    <select class="form-select" name="account_guide_id">
                        <option value="">كل الدلائل</option>
                        @foreach($account_guides as $account_guide)
                            <option value="{{ $account_guide->id }}" {{ $account_guide_id == $account_guide->id ? 'selected' : '' }}>{{ $account_guide->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- @php
        $price = 0 ;
    @endphp
   @foreach($invoices_all->where('type',0) as $invoice)
   @foreach($invoice->invoice_items as $sellinginvoice)
   @php
   $price = $price + ($sellinginvoice->purchasing_price)
   @endphp

   @endforeach
   @endforeach --}}

    @if($index_accounts->count())
        <div class="row">
            <div class="table-responsive-sm pb-3">
                <table class="table table-responsive-sm table-borderless mb-md-5">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">رقم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">اسم الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">تابع لحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">القائمة المالية</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1"> طبيعة الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">رصيد الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white py-1">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($index_accounts as $index_account)
                        {{-- @foreach($index_account->invoice_items as $index_accountitem) --}}
                        <tr>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p"><a
                                            href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_number }}</a>
                                </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p"><a
                                            href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_name }}</a>
                                </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">@if($index_account->parent)
                                        <a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->parent->id]) }}">{{ $index_account->parent->account_name }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <!-- <td class="text-center p-1"><div class="bg-white rounded-2 py-1 min-h-40p">{{ \App\Models\IndexAccount::basicList($index_account->basic) }}</td> -->
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">@if($index_account->account_guide)
                                        <a href="{{ route('account-guides.show', ['account_guide_id' => $index_account->account_guide ? $index_account->account_guide->id : '']) }}">{{ $index_account->account_guide ? $index_account->account_guide->title : '' }}</a>
                                    @else
                                        -
                                    @endif </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $index_account->nature_account }}
                                    &nbsp;
                                </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $index_account->total_price }} </div>
                            </td>

                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">
                                    <livewire:index-accounts.index-account-edit :index_account_id="$index_account"
                                                                                :key="'index-account-edit-index-accounts-'.$index_account->id"></livewire:index-accounts.index-account-edit>
                                    <livewire:index-accounts.index-account-delete :index_account_id="$index_account"
                                                                                  :key="'index-account-delete-index-accounts-'.$index_account->id"></livewire:index-accounts.index-account-delete>
                                    <button wire:click="viewindexaccountreport({{$index_account->id}})" type="button"
                                            class="btn btn-sm text-success "
                                            data-bs-toggle="modal" data-bs-target="#modalFormviewReport">
                                        <i class="fa fa-file"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
            </div>{{ __('Empty index accounts') }}</div>
    @endif
    {{--    @endif--}}
</div>

