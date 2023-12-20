<div class="d-inline">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalFormIndexAccount">
        انشاء فهرس حساب
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormIndexAccount" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content px-3 rounded-4">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center text-primary border-bottom">
                    <h5 class="" id="exampleModalLabel">فهرس الحسابات</h5>
                </div>
                <form wire:submit.prevent="store" class="modal-body row">
                    <div class="form-group col-6">
                        <label for="">رقم الحساب</label>
                        <input wire:model.defer="index_account.account_number" type="number" class="form-control">
                        @error('index_account.account_number')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">اسم الحساب</label>
                        <input wire:model.defer="index_account.account_name" type="text" class="form-control">
                        @error('index_account.account_name')<span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">تابع لحساب</label>
                        <select wire:model.defer="index_account.index_account_id" name="index_account_id"
                                class="form-select">
                            <option value="">لا يوجد</option>
                            @foreach($index_accounts as $index_account)
                                <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                            @endforeach
                        </select>
                        @error('index_account.index_account_id') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <!-- <div class="form-group col-6">
                        <label for="">أساسي</label>
                        <select wire:model.defer="index_account.basic" name="basic" class="form-control">
                            @foreach(\App\Models\IndexAccount::basicList() as $key => $basic)
                        <option value="{{ $key }}">{{ $basic }}</option>

                    @endforeach
                    </select>
@error('index_account.basic') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div> -->
                    <div class="form-group col-6">
                        <label for="">القائمة المالية </label>
                        <select wire:model.defer="index_account.account_guide_id" name="account_guide_id"
                                class="form-select">
                            <option value="">لا يوجد</option>
                            @foreach($account_guides as $account_guide)
                                <option value="{{ $account_guide->id }}">{{ $account_guide->title }}</option>
                            @endforeach
                        </select>
                        @error('index_account.account_guide_id') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="">طبيعة الحساب</label>
                        <select wire:model.defer="index_account.nature_account" name="nature_account"
                                class="form-select">
                            <option value="">لا يوجد</option>
                            @foreach($nature_account as $nature_accounts)
                                <option value="{{ $nature_accounts->id }}">{{ $nature_accounts->title }}</option>
                            @endforeach

                        </select>
                        @error('index_account.account_guide_id') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <!-- <div class="form-group col-6">
                        <label for="">الرصيد</label>
                        <input wire:model.defer="index_account.balance" type="number" class="form-control">
                        @error('index_account.balance')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div> -->
                    <div class="col-12 align-self-end text-center mt-3">
                        <button wire:loading.attr="disabled" type="submit"
                                class="btn btn-primary w-25">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
