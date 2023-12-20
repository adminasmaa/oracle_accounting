<div>
    <livewire:invoice-items.invoice-item-create :invoice_id="$invoice->id"
                                                :key="'invoice-item-create-invoice-items-'. $invoice->id"></livewire:invoice-items.invoice-item-create>

    @if(count($invoice_items))

        <div class="row">
            @include("layouts.shared.msg")

            <div class="page-content container">
                <h3>رقم الفاتورة: #{{$invoice->invoice_number}}</h3>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">الاسم:{{ $invoice->user ? $invoice->user->name : '' }}</span>

                                    </div>

                                </div>
                                <!-- /.col -->

                                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                    <hr class="d-sm-none"/>
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            الفاتورة
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                    class="text-600 text-90">رقم الفاتوره:</span> {{$invoice->invoice_number}}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                    class="text-600 text-90"> تاريخ الفاتورة:</span>@if($invoice->invoice_date != null)
                                                {{ $invoice->invoice_date }}
                                            @else
                                                -
                                            @endif</div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="mt-4">
                                <table class="table table-responsive">
                                    <tr>
                                        <td>حذف</td>
                                        <td>رقم الصنف</td>
                                        <td>اسم الصنف</td>
                                        <td>وحدة الصنف</td>
                                        <td> الكمية</td>
                                        @if($invoice->type == 1)
                                            <td>سعر الشراء</td>
                                        @else
                                            <td>سعر البيع</td>
                                        @endif

                                        @if($invoice->type == 1)
                                            <td class="col-2">اجمالي الشراء</td>
                                        @else
                                            <td class="col-2">اجمالي البيع</td>
                                        @endif
                                    </tr>

                                    @php
                                        $AllDecount = 0;
                                        foreach($invoice->invoice_discounts as $discou){
                                                $AllDecount = $AllDecount + ($discou->discount_quantity);
                                        }

                                        $ArrestValue = 0;

                                        foreach($invoice->arrest_receipts as $resept){
                                                $ArrestValue = $ArrestValue + ($resept->batch_quantity);
                                        }

                                        $total = 0;
                                    @endphp
                                    @foreach($invoice_items as $key => $invoice_item)
                                        <tr>
                                            @php
                                                if ($invoice->type == 1){
                                                    $total = $total + ($invoice_item['purchasing_price'] * $invoice_item['quantity']);
                                                } else {
                                                    $total = $total + ($invoice_item['selling_price'] * $invoice_item['quantity']);
                                                }
                                            @endphp

                                            <td>
                                                <button wire:click="DeleteItem({{$invoice_item['id']}})"
                                                        class="btn btn-danger"><i class="fa fa-times"></i></button>
                                            </td>
                                            <td>
                                                <a href="{{ route('items.show', ['item_id' => $invoice_item['item_id']]) }}">{{ $invoice_item['unit_id'] }}</a>
                                            </td>
                                            <td>{{ $invoice_item['item_name'] }}</td>
                                            <td>
                                                <select class="form-control"
                                                        wire:model.defer="invoice_items.{{$key}}.unit_id">
                                                    <option value=""></option>
                                                    @foreach($invoice_item['item']['units'] as $unit)
                                                        <option value="{{$unit['id']}}">{{$unit['name']}}</option>
                                                    @endforeach
                                                </select>
                                            <td><input class="form-control"
                                                       wire:model.defer="invoice_items.{{$key}}.quantity"
                                                       wire:change="UpdateItem()"></td>
                                            @if($invoice->type == 1)
                                                <td><input class="form-control"
                                                           wire:model.defer="invoice_items.{{$key}}.purchasing_price"
                                                           wire:change="UpdateItem()"></td>
                                            @else
                                                <td><input class="form-control"
                                                           wire:model.defer="invoice_items.{{$key}}.selling_price"
                                                           wire:change="UpdateItem()"></td>
                                            @endif

                                            @if($invoice->type == 1)
                                                <td>{{ $invoice_item['purchasing_price'] * $invoice_item['quantity'] }}</td>
                                            @else
                                                <td>{{ $invoice_item['selling_price'] * $invoice_item['quantity'] }}</td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </table>


                                <div class="row border-b-2 brc-default-l2"></div>


                                <div class="row mt-3">
                                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                                    </div>

                                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                        <div class="row my-2">
                                            <div class="col-7 text-right">
                                                السعر الكلي
                                            </div>
                                            <div class="col-5">
                                                <span class="text-120 text-secondary">{{$total}}</span>
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-7 text-right  mb-7 text-center ">
                                            <span style="margin: 10px auto;  !important">
                                            @if($invoice->type == 1)
                                                    <div class="mt-4"> الخصم المكتسب </div>
                                                @else
                                                    <div class="mt-4"> الخصم المسموح بة </div>
                                                @endif
                                            </span>
                                            </div>
                                            <div class="col-5">
                                                <livewire:invoice-discounts.invoice-discount-create
                                                        :invoice_id="$invoice->id"
                                                        :key="'invoice-discount-create-invoice-discounts-'. $invoice->id"></livewire:invoice-discounts.invoice-discount-create>
                                            </div>

                                        </div>


                                        <div class="row my-2">
                                            <div class="col-7 text-right mt-4">السعر بعد الخصم</div>
                                            <div class="col-5">
                                                {{$total - $AllDecount}}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-7 text-right mt-4">
                                                الدفعة
                                            </div>
                                            <div class="col-5">
                                                <livewire:arrest-receipts.arrest-receipt-create
                                                        :invoice_id="$invoice->id"
                                                        :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create>
                                            </div>

                                        </div>


                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                            <div class="col-7 text-right">
                                                السعر النهائي
                                            </div>
                                            <div class="col-5">

                                                <span class="text-150 text-success-d3 opacity-2">{{$total - ($AllDecount +$ArrestValue)}}</span>

                                                    <?php $TotalPrice = $total - ($AllDecount + $ArrestValue) ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <button wire:click="updateActivite({{$total - $AllDecount}},{{$TotalPrice}})" type="button"
                        class="btn btn-primary mb-3">
                    حفظ
                </button>

                @else
                    <div class="mb-3 text-center fs-4 py-3">
                        <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                        </div>{{ __('Empty invoice items') }}</div>
                @endif
            </div>

