<div>
    @php

        $invMouRec = $invoice != null ? $invoice->id : 0
    @endphp
    @if(!$invMouRec)
        <div class="row">
            <div class="col-md-4">
                {{-- <livewire:arrest-receipts.arrest-receipt-create :invoice_id="($invoice?$invoice->id:0)" :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create> --}}

                <button wire:click="add_arrest({{(request('type')?request('type'):0)}})" type="button" class="btn btn-primary mb-3"
                        data-bs-toggle="modal" data-bs-target="#modalFormArrestReceiptsCreate">
                    <!-- {{$type}} -->
                    @if(array_key_exists(request('type'),\App\Models\ArrestReceipt::typeList(false)))
                        @if(\App\Models\ArrestReceipt::typeList(request('type')) == 'صادرة')
                            {{ __('Create a receipt') }}
                        @else
                            {{ __('Create a voucher') }}

                        @endif
                    @else
                        انشاء ايصال
                    @endif
                </button>

            </div>
            <div class="col-md-8 text-start">
                <form class="row g-1 justify-content-end">
                    <div class="col-md-auto col-6 text-startmb-2">
                        <select class="form-select" name="invoice_id">
                            <option value="">كل الفواتير</option>
                            @foreach($invoices as $invoice)
                                <option value="{{  $invoice->id }}" {{ (!empty($invoice_id) and  $invoice_id == $invoice->id) ? 'selected' : '' }}>{{ $invoice->invoice_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-auto col-6 text-startmb-2">
                        <select class="form-select" name="user_id">
                            <option value="">كل المستخدمين</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-auto col-10 text-startmb-2">
                        <select name="type" wire:model.defer="type" class="form-select">
                            <option value="">كل الأنواع</option>
                            @foreach(\App\Models\ArrestReceipt::typeList(false) as $key => $type)
                                <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 col-2 text-end mb-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <livewire:arrest-receipts.arrest-receipt-create :invoice_id="($invoice?$invoice->id:0)"
                                                        :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create>
    @endif

    @if($arrest_receipts->count())
        <div class="row">
            <div class="table-responsive-sm pb-3">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        @if(!$invMouRec)
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الفاتورة</div>
                            </th>

                            @if(request('type') == 0)
                                <th scope="col" class="text-center p-1">
                                    <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم الزبون</div>
                                </th>
                            @else
                                <th scope="col" class="text-center p-1">
                                    <div class="bg-primary rounded-2 text-white p-1 min-h-40p">اسم المورد</div>
                                </th>
                            @endif
                        @endif
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">تاريخ الدفعة</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">كمية الدفعة</div>
                        </th>
                        {{-- <th scope="col" class="text-center p-1">النوع</th> --}}
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($arrest_receipts as $arrest_receipt)

                         <tr>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            @if(!$invMouRec)
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">@if($arrest_receipt->invoice)<a
                                                href="{{ route('invoices.show', ['invoice_id' => $arrest_receipt->invoice ? $arrest_receipt->invoice->id : '']) }}">{{ $arrest_receipt->invoice ? $arrest_receipt->invoice->invoice_number : '' }}@else
                                                -
                                            @endif</a>
                                    </div>
                                </td>
                                <td class="text-center align-middle p-1">
                                    <div class="bg-white rounded-2 py-1 min-h-40p">@if($arrest_receipt->user)<a
                                                href="{{ route('users.show', ['user_id' => $arrest_receipt->user ? $arrest_receipt->user->id : '']) }}">{{ $arrest_receipt->user ? $arrest_receipt->user->name : '' }}@else
                                                -
                                            @endif</a>
                                    </div>
                                </td>
                            @endif
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $arrest_receipt->date }}</div>
                            </td>
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">{{ $arrest_receipt->advance }}</div>
                            </td>
                            {{-- <td class="text-center align-middle p-1">{{ \App\Models\ArrestReceipt::typeList($arrest_receipt->type) }}</td> --}}
                            <td class="text-center align-middle p-1">
                                <div class="bg-white rounded-2 py-1 min-h-40p">
                                    <a href="/details-show/{{$arrest_receipt['id']}}" class="btn btn-sm text-primary border-end">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <livewire:arrest-receipts.arrest-receipt-delete
                                            :arrest_receipt_id="$arrest_receipt->id"
                                            :invoice_id="($invoice?$invoice->id:0)"
                                            :key="'arrest-receipt-delete-arrest-receipts-'.$arrest_receipt->id"></livewire:arrest-receipts.arrest-receipt-delete>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" scope="col" class="text-center p-1">
                            <div class="bg-primary text-white rounded-2 py-1 min-h-40p">المجموع</div>
                        </th>
                        <th colspan="2" scope="col" class="text-center p-1">
                            <div class="bg-white rounded-2 py-1 min-h-40p">{{ $total }}</div>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
            {{ $arrest_receipts->links() }}
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
            </div>{{ __('Empty arrest receipts') }}</div>

    @endif
</div>

