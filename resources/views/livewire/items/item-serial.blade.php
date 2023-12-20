<div class="d-inline">
    <div class="row">
        <div class="form-group col-2">
            <label for="">الكمية</label>
            <input wire:model.defer="invoice_item.quantity" type="number" class="form-control">
            @error('invoice_item.quantity')<span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-2">
            <label for="">الوصف</label>
            <textarea wire:model.defer="invoice_item.description" rows="1" class="form-control"></textarea>
            @error('invoice_item.description')<span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <!-- <div class="mt-4 col-2 text-center">
                <button wire:loading.attr="disabled" type="submit" style="background-color: #478fcc;color:white" class="btn">{{ __('Add') }}</button>
            </div> -->
    </div>


</div>
