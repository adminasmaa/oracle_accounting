<div class="d-inline">
    <button type="button" class="btn btn-sm text-primary border-end" data-bs-toggle="modal"
            data-bs-target=".modalFormEditCategory{{$category['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditCategory{{$category['id']}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header">
                    <h5 class="modal-title">الأقسام</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input wire:model.defer="category.name" type="text" class="form-control">
                        @error('category.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الوصف</label>
                        <textarea wire:model.defer="category.description" class="form-control"></textarea>
                        @error('category.description')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الصورة</label>
                        <input wire:model.defer="category.path" type="file" class="form-control"/>
                        @error('category.path') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit"
                                class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
