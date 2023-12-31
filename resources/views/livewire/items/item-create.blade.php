<div class="d-inline">


    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalFormItem">
        انشاء صنف
    </button>

    <!-- @include("layouts.shared.msg") -->
    <div wire:ignore.self class="modal fade" id="modalFormItem" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center border-bottom ">
                    <h5 class="modal-title" id="exampleModalLabel">الأصناف</h5>
                </div>
                @include("layouts.shared.msg")
                <form wire:submit.prevent="store" class="modal-body">
                    <nav>
                        <div class="nav nav-tabs pb-3" id="nav-tab" role="tablist">
                            <button class="nav-link mx-1 active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">البيانات الأساسيه
                            </button>
                            <button class="nav-link mx-1" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">البيانات الفرعيه
                            </button>
                            {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="form-group">
                                    <label for="">الاسم</label>
                                    <input wire:model.defer="item.name" type="text" class="form-control">
                                    @error('item.name')<span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group fail-o">
                                    <label for="">الصورة</label>

                                    <input wire:model.defer="item.path" type="file" class="form-control"/>
                                    @error('item.path') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="">رمز الصنف</label>
                                    <input wire:model.defer="item.item_number" type="text" class="form-control">
                                    @error('item.item_number')<span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="">رقم تسلسلي</label>
                                    <input wire:model.defer="item.serial_number" type="text" class="form-control">
                                    @error('item.serial_number')<span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                </div>


                                <div class="form-group col-12">
                                    <label for="">مكان التواجد</label>
                                    <input wire:model.defer="item.place" type="text" class="form-control">
                                    @error('item.place')<span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group">
                                <label for="">القسم</label>
                                <input wire:model.defer="category" type="text" class="form-control">
                                @error('category')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>


                            {{-- <div class="form-group">
                                <label for="">القسم</label>
                                <select wire:model.defer="item.category_id" name="category_id" class="form-control">
                                    <option value="">{{ __('Nothing') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('item.category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="">الوحدة</label>
                                <input wire:model.defer="item.unit" type="text" class="form-control">
                                @error('item.unit')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div> --}}

                            <div class="form-check">
                                <input wire:model.defer="item.serial_multi" class="form-check-input" type="checkbox"
                                       id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    متعدد السيريال
                                </label>
                                @error('item.serial_multi') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>


                        <div class="mt-4 text-center">
                            <button wire:loading.attr="disabled" type="submit"
                                    class="btn btn-primary w-50">{{ __('Save') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
