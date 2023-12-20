<div>
    {{-- <livewire:invoices.invoice-create wire:click="addinvoice"  :key="'invoice-create-invoices-'"></livewire:invoices.invoice-create> --}}
    <button wire:click="addinvoice({{(request('type')?request('type'):0)}})" type="button" class="btn btn-primary mb-3"
            data-bs-toggle="modal" data-bs-target="#modalFormInvoice">
        @if(array_key_exists(request('type'),\App\Models\Invoice::typeList(false)))
            {{ __('Create invoice').' '. \App\Models\Invoice::typeList(request('type')) }}
        @else
            انشاء فاتورة
        @endif
    </button>
    <button wire:click="invoicereports()" type="button" class="btn shadow-sm btn-primary mb-3 mx-1 btn"
            title="تقرير فواتير البيع">
        <i class="fa fa-file"></i>
    </button>

    <form class="row g-0 mb-4 justify-content-center form-export">
        <div class="col-md-4 col-6 mt-2 ps-1">
            <label class="text-primary mb-2 fw-bold" for="search-o">
                البحث بالرقم أو الوصف
            </label>

            <input id="search-o" name="search" placeholder="البحث بالرقم أو الوصف" type="text" class="form-control"
                   value="{{ $search }}">
        </div>
        <div class="col-md-2 col-6 mt-2 ps-1">
            <label class="text-primary mb-2 fw-bold" for="from-o">
                من تاريخ
                {{--                <i  class="fa-solid fa-calendar icon-date" ></i>--}}
            </label>
            <input id="from-o" name="from" type="date" class="form-control" value="{{ $from }}">
        </div>

        <div class="col-md-2 col-6 mt-2 ps-1">
            <label class="text-primary mb-2 fw-bold" for="to-o">
                إلى تاريخ
                {{--                <i  class="fa-solid text-primary fa-calendar icon-date" ></i>--}}
            </label>
            <input name="to" id="to-o" type="date" class="form-control" value="{{ $to }}">
        </div>
        <div class="col-md-3 col-6 mt-2 ps-1 position-relative">
            <label class="text-primary mb-2 fw-bold" for="user_id-o">
                الموردين
            </label>

            <select class="form-select" id="user_id-o" name="user_id">
                @if(request('type') == 1)
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

        <div class="col-md-1 col-6 mt-2  ps-1 text-start align-self-end">
            <button type="submit" class="btn w-100 btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                        @if(request('type') == 1)
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم المورد</div>
                            </th>
                        @else
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الزبون</div>
                            </th>
                        @endif
                        {{-- <th scope="col" class="text-center p-1">اسم فهرس الحساب</th> --}}
                        <!-- <th scope="col" class="text-center p-1">الحالة</th>
                        <th scope="col" class="text-center p-1">النوع</th> -->
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
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p"><a
                                            href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a>
                                </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->description != null)
                                        <a
                                                href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->description }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->invoice_date !=
                            null)
                                        {{ $invoice->invoice_date }}
                                    @else
                                        -
                                    @endif </div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($invoice->user)
                                        <a
                                                href="{{ route('users.show', ['user_id' => $invoice->user ? $invoice->user->id : '']) }}">{{ $invoice->user ? $invoice->user->name : '' }}</a>
                                    @else
                                        -
                                    @endif </div>
                            </td>
                            {{-- <td class="text-center p-1">@if($invoice->index_account)<a href="{{ route('index-accounts.show', ['index_account_id' => $invoice->index_account ? $invoice->index_account->id : '']) }}">{{ $invoice->index_account ? $invoice->index_account->account_name : '' }}</a>@else
                            - @endif</td> --}}

                            <!-- <td class="text-center p-1">{{ \App\Models\Invoice::statusList($invoice->status) }}
                            </td>
                            <td class="text-center p-1">{{ \App\Models\Invoice::typeList($invoice->type) }}</td> -->
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $invoice->total_price }}</div>
                            </td>
                            <td class="text-center p-1">
                                <div class="bg-white rounded-2 p-1 min-h-40p">
                                    <a href="/invoices/{{$invoice['id']}}" class="btn btn-sm text-primary border-end" >
                                        <i class="fa fa-edit"></i>
                                    </a>
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