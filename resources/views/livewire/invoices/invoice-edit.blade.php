<div class="d-inline">
    <button type="button" class="btn btn-sm text-primary border-end" data-bs-toggle="modal"
            data-bs-target=".modalFormEditInvoice{{$invoice['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditInvoice{{$invoice['id']}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="modal-title text-primary border-bottom pb-3 ">الفواتير</h5>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="row">
                        <div class="form-group text-start col-6">
                            <label class="text-primary" for="">رقم الفاتورة</label>
                            <input wire:model.defer="invoice.invoice_number" type="text" class="form-control">
                            @error('invoice.invoice_number')<span
                                    class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6">
                            <label class="text-primary" for="">الوصف</label>
                            <textarea rows="1" wire:model.defer="invoice.description" class="form-control"></textarea>
                            @error('invoice.description')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">تاريخ الفاتورة</label>
                            <input wire:model.defer="invoice.invoice_date" type="date" class="form-control">
                            @error('invoice.invoice_date')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">آخر وقت لدفع الفاتورة</label>
                            <input wire:model.defer="invoice.last_invoice_payment_date" type="date"
                                   class="form-control">
                            @error('invoice.last_invoice_payment_date')<span
                                    class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">تاريخ دفع الفاتورة</label>
                            <input wire:model.defer="invoice.invoice_payment_date" type="date" class="form-control">
                            @error('invoice.invoice_payment_date')<span
                                    class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">المستخدم</label>
                            <select wire:model.defer="invoice.user_id" name="user_id" class="form-select">
                                <option value="">{{ __('Nothing') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('invoice.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">فهرس الحساب</label>
                            <select wire:model.defer="invoice.index_account_id" name="index_account_id"
                                    class="form-select">
                                <option value="">{{ __('Nothing') }}</option>
                                @foreach($index_accounts as $index_account)
                                    <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                                @endforeach
                            </select>
                            @error('invoice.index_account_id') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">الحالة</label>
                            <select wire:model.defer="invoice.status" name="status" class="form-select">
                                @foreach(\App\Models\Invoice::statusList() as $key => $status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('invoice.status') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">النوع</label>
                            <select wire:model.defer="invoice.type" name="type" class="form-select">
                                @foreach(\App\Models\Invoice::typeList() as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('invoice.type') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group text-start col-6 mt-3">
                            <label class="text-primary" for="">السعر الاجمالي</label>
                            <input wire:model.defer="invoice.total_price" type="number" class="form-control">
                            @error('invoice.total_price')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mt-4 text-center">
                            <button wire:loading.attr="disabled" type="submit"
                                    class="btn btn-primary w-50 mx-auto">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
