<div class="text-center p-3">
    <div class="row">
        <div class="table-responsive-sm pb-3">
            <table class="table table-responsive-md table-borderless">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تابع لحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">أساسي</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">القائمة المالية</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رصيد الحساب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">{{ $index_account->account_number }}</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p"><a
                                    href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_name }}</a>
                        </div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">@if($index_account->parent)
                                <a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->parent->id]) }}">{{ $index_account->parent->account_name }}</a>
                            @else
                                -
                            @endif</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">{{ \App\Models\IndexAccount::basicList($index_account->basic) }}</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">@if($index_account->account_guide)
                                <a href="{{ route('account-guides.show', ['account_guide_id' => $index_account->account_guide ? $index_account->account_guide->id : '']) }}">{{ $index_account->account_guide ? $index_account->account_guide->title : '' }}</a>
                            @else
                                -
                            @endif</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">{{ $index_account->balance }}</div>
                    </td>
                    <td class="text-center align-middle p-1">
                        <div class="bg-white rounded-2 p-1 min-h-40p">
                            <livewire:index-accounts.index-account-edit :index_account_id="$index_account->id"
                                                                        :key="'index-account-edit-index-account-show-'.$index_account->id"></livewire:index-accounts.index-account-edit>
                            <livewire:index-accounts.index-account-delete :index_account_id="$index_account->id"
                                                                          :key="'index-account-delete-index-account-show-'.$index_account->id"></livewire:index-accounts.index-account-delete>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @if($invoices->count())
            <div class="table-responsive-sm pb-3">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#7777</div>
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
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم المستخدم</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم فهرس الحساب</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الحالة</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">النوع</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">السعر الاجمالي</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p"><a
                                            href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a>
                                </div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->description != null)
                                        <a href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->description }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->invoice_date != null)
                                        {{ $invoice->invoice_date }}
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->user)
                                        <a href="{{ route('users.show', ['user_id' => $invoice->user ? $invoice->user->id : '']) }}">{{ $invoice->user ? $invoice->user->name : '' }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->index_account)
                                        <a href="{{ route('index-accounts.show', ['index_account_id' => $invoice->index_account ? $invoice->index_account->id : '']) }}">{{ $invoice->index_account ? $invoice->index_account->account_name : '' }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ \App\Models\Invoice::statusList($invoice->status) }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ \App\Models\Invoice::typeList($invoice->type) }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $invoice->total_price }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">
                                    <livewire:invoices.invoice-edit :invoice_id="$invoice->id"
                                                                    :key="'invoice-edit-index-account-show-'.$invoice->id"></livewire:invoices.invoice-edit>
                                    <livewire:invoices.invoice-delete :invoice_id="$invoice->id"
                                                                      :key="'invoice-delete-index-account-show-'.$invoice->id"></livewire:invoices.invoice-delete>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $invoices->links() }}
        @else
            <div class="alert text-center alert-danger mt-4">{{ __('Empty invoices this account') }}</div>
        @endif
    </div>
</div>
