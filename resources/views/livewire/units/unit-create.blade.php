<div class="d-inline">
    <button type="button" class="btn btn-sm text-success border-end" data-bs-toggle="modal"
            data-bs-target=".modalFormCreateItem{{$unit['item_id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormCreateItem{{$unit['item_id']}}" id="modalFormUnit" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="modal-title text-primary border-bottom pb-3" id="exampleModalLabel">الوحدات</h5>
                <form wire:submit.prevent="store" class="row">
                    <div class="form-group col-6">
                        <label for="">الاسم</label>
                        <input wire:model.defer="unit.name" type="text" class="form-control">
                        @error('unit.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">عدد القطع</label>
                        <input wire:model.defer="unit.pieces" type="number" class="form-control">
                        @error('unit.pieces')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">سعر الشراء</label>
                        <input wire:model.defer="unit.purchasing_price" type="text" class="form-control">
                        @error('unit.purchasing_price')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">سعر البيع</label>
                        <input wire:model.defer="unit.selling_price" type="text" class="form-control">
                        @error('unit.selling_price')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">وحدة القياس</label>
                        <input wire:model.defer="unit.measruing_unit" type="text" class="form-control">
                        @error('unit.measruing_unit')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">الوحدة</label>
                        <select wire:model.defer="unit.item_id" name="item_id" class="form-select">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit"
                                class="btn btn-primary w-25 mb-3">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
