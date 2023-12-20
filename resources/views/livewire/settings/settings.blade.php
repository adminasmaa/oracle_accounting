<div>
    @if($settings->count() == 0)
        <livewire:settings.setting-create :key="'setting-create-settings-'"></livewire:settings.setting-create>
    @endif
    <div class="row">
        <form wire:submit.prevent="update" class="col-md-9 ">

            <div class="form-group mb-3">
                <label for="">اسم الشركة</label>
                <input wire:model.defer="setting.company_name" type="text" class="form-control">
                @error('setting.company_name')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">شعار الشركة</label>
                <input wire:model.defer="setting.path" type="file" class="form-control"/>
                @error('setting.path') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">هاتف الشركة</label>
                <input wire:model.defer="setting.company_phone" type="number" class="form-control">
                @error('setting.company_phone')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">بريد الشركة</label>
                <input wire:model.defer="setting.company_email" type="email" class="form-control">
                @error('setting.company_email')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">عنوان الشركة</label>
                <input wire:model.defer="setting.company_address" type="text" class="form-control">
                @error('setting.company_address')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">مدير الشركة</label>
                <input wire:model.defer="setting.company_manager" type="text" class="form-control">
                @error('setting.company_manager')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="">وصف الشركة</label>
                <input wire:model.defer="setting.company_description" type="text" class="form-control">
                @error('setting.company_description')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="mt-4">
                <button wire:loading.attr="disabled" type="submit"
                        class="btn btn-primary w-25">{{ __('Save') }}</button>
            </div>
        </form>
    </div>

</div>