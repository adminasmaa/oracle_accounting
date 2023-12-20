<div class="d-inline" id="item-{{$item['id']}}" wire:key="key-{{$item['id']}}">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
            data-bs-target=".modalFormEditItem{{$item['id']}}" wire:click="ProjectEditOpenModal({{$item['id']}})">
        <i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditItem{{$item['id']}}" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">الأصناف</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:ignore.self wire:submit.prevent="update" class="modal-body ">
                    <nav>
                        <div wire:ignore.self class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button wire:ignore class="nav-link active" id="nav-homeEdit{{$item['id']}}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-homeEdit{{$item['id']}}" type="button"
                                    role="tab" aria-controls="nav-home" aria-selected="true">البيانات الأساسية
                            </button>
                            <button wire:ignore class="nav-link" id="nav-profileEdit{{$item['id']}}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-profileEdit{{$item['id']}}" type="button"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">البيانات الفرعية
                            </button>
                            <button wire:ignore class="nav-link" id="nav-serial{{$item['id']}}-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-serial{{$item['id']}}" type="button" role="tab"
                                    aria-controls="nav-serial" aria-selected="false"> باركود
                            </button>

                            <button wire:ignore class="nav-link" id="nav-manufacturing{{$item['id']}}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-manufacturing{{$item['id']}}"
                                    type="button"
                                    role="tab" aria-controls="nav-manufacturing" aria-selected="false"> التصنيع
                            </button>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div wire:ignore.self class="tab-pane fade show active" id="nav-homeEdit{{$item['id']}}"
                             role="tabpanel" aria-labelledby="nav-homeEdit{{$item['id']}}-tab">
                            <div class="form-group">
                                <label for="">الاسم</label>
                                <input wire:model.defer="item.name" type="text" class="form-control">
                                @error('item.name')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">الصورة</label>
                                <input wire:model.defer="item.path" type="file" class="form-control"/>
                                @error('item.path') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">وحدة القياس</label>
                                <select wire:model.defer="item.unit" name="unit" class="form-control">
                                    @foreach(\App\Models\Item::unitList() as $key => $unit)
                                        <option value="{{ $key }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                                @error('item.unit') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">رمز الصنف</label>
                                <input wire:model.defer="item.item_number" type="text" class="form-control">
                                @error('item.item_number')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">رقم تسلسلي</label>
                                <input wire:model.defer="item.serial_number" type="text" class="form-control">
                                @error('item.serial_number')<span
                                        class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">مكان التواجد</label>
                                <input wire:model.defer="item.place" type="text" class="form-control">
                                @error('item.place')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="nav-profileEdit{{$item['id']}}" role="tabpanel"
                             aria-labelledby="nav-profileEdit{{$item['id']}}-tab">

                            <div class="form-group">
                                <label for="">القسم</label>
                                <select wire:model.defer="item.category_id" name="category_id" class="form-control">
                                    <option value="">{{ __('Nothing') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('item.category_id')
                                <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-check">
                                <input wire:click="like()" wire:model="item.serial_multi" class="form-check-input"
                                       type="checkbox" id="flexCheckDefault"/>
                                <label class="form-check-label" for="flexCheckDefault"> متعدد السيريال </label>
                                @error('item.serial_multi')
                                <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="nav-unitEdit{{$item['id']}}" role="tabpanel"
                             aria-labelledby="nav-unitEdit{{$item['id']}}-tab">
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>الاسم</th>
                                    <th>العدد</th>
                                    <th>سعر الشراء</th>
                                    <th>سعر البيع</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($unitsele as $index => $unititem)

                                    @if($index==0)

                                        <tr>
                                            <td><span class="input-group-text" id=""> الوحده الاولي</span></td>
                                            {{-- <input wire:model.defer="firstunits.check" class="form-check-input" type="checkbox"id="flexCheckDefault"> --}}
                                            <td>

                                                <input wire:model.defer="firstunits.name" value="{{$unititem->name}}"
                                                       type="text" class="form-control mr-2"
                                                       placeholder="{{$unititem->name}}">

                                            </td>
                                            <td>
                                                <input wire:model.defer="firstunits.pieces"
                                                       value="{{$unititem->pieces}}"
                                                       type="text" placeholder="{{$unititem->pieces}}"
                                                       class="form-control mr-2">

                                            </td>
                                            <td>
                                                <input wire:model.defer="firstunits.selling_price"
                                                       value="{{$unititem->selling_price}}" type="text"
                                                       placeholder="{{$unititem->selling_price}}"
                                                       class="form-control mr-2">

                                            </td>
                                            <td>
                                                <input wire:model.defer="firstunits.purchasing_price"
                                                       value="{{$unititem->purchasing_price}}" type="text"
                                                       placeholder="{{$unititem->purchasing_price}}"
                                                       class="form-control mr-2">

                                            </td>
                                        </tr>

                                    @endif
                                @endforeach

                                </tbody>
                            </table>

                            @foreach ($unitsele as $index => $unititem)

                                @if($index==1)
                                    @php
                                        $id_two = $unititem->id
                                    @endphp
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id=""> الوحده الثانية</span>
                                        </div>
                                        <input wire:model.defer="secoundunits.name" value="{{$unititem->name}}"
                                               type="text"
                                               class="form-control mr-2" placeholder="{{$unititem->name}}">
                                        <input wire:model.defer="secoundunits.pieces" value="{{$unititem->pieces}}"
                                               type="text"
                                               placeholder=" {{$unititem->pieces}}" class="form-control mr-2">
                                        <input wire:model.defer="secoundunits.selling_price"
                                               value="{{$unititem->selling_price}}" type="text"
                                               placeholder="{{$unititem->selling_price}}" class="form-control mr-2">
                                        <input wire:model.defer="secoundunits.purchasing_price"
                                               value="{{$unititem->purchasing_price}}" type="text"
                                               placeholder=" {{$unititem->purchasing_price}}" class="form-control mr-2">
                                    </div>

                                @endif
                            @endforeach




                            @foreach ($unitsele as $index => $unititem)

                                @if($index==2)
                                    @php
                                        $id_three = $unititem->id
                                    @endphp
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id=""> الوحده الثالثة</span>

                                        </div>
                                        <input wire:model.defer="thirdunits.name" value="" type="text"
                                               class="form-control mr-2"
                                               placeholder="{{$unititem->name}}">
                                        <input wire:model.defer="thirdunits.pieces" value="{{$unititem->pieces}}"
                                               type="text"
                                               placeholder=" {{$unititem->pieces}}" class="form-control mr-2">
                                        <input wire:model.defer="thirdunits.selling_price"
                                               value="{{$unititem->selling_price}}"
                                               type="text" placeholder=" {{$unititem->selling_price}}"
                                               class="form-control mr-2">
                                        <input wire:model.defer="thirdunits.purchasing_price"
                                               value="{{$unititem->purchasing_price}}" type="text"
                                               placeholder=" {{$unititem->purchasing_price}}" class="form-control mr-2">
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="nav-serial{{$item['id']}}" role="tabpanel"
                             aria-labelledby="nav-serial{{$item['id']}}-tab">

                            <table>
                                <tbody>
                                @foreach ($unitsele as $index => $unititem)

                                    <div class="row">
                                        <div class="input-group m-1">
                                            <div class="input-group-prepend col-xs-2">
                                                <span class="input-group-text"
                                                      id=""> الوحده رقم {{++$index}}</span>
                                            </div>
                                            <div class="col-xs-2">
                                                <input wire:model.defer="firstunits.name"
                                                       value="{{$unititem->id}}"
                                                       type="hidden" class="form-control mr-2"
                                                       placeholder="{{$unititem->id}}">
                                                <input wire:model.defer="unit.{{$unititem->id}}.name" type="text"
                                                       name="{{$unititem->name}}" value="{{$unititem->name}}"
                                                       placeholder="{{$unititem->name}}"
                                                       class="form-control mr-2 col-xs-2">
                                            </div>
                                            <input wire:model.defer="unit.{{$unititem->id}}.pieces"
                                                   value="{{$unititem->pieces}}"
                                                   type="text" placeholder="{{$unititem->pieces}}"
                                                   class="form-control mr-2 col-xs-2">
                                            <input wire:model.defer="unit.{{$unititem->id}}.selling_price"
                                                   value="{{$unititem->selling_price}}" type="text"
                                                   placeholder="{{$unititem->selling_price}}"
                                                   class="form-control mr-2 col-xs-2">
                                            <input wire:model.defer="unit.{{$unititem->id}}.purchasing_price"
                                                   value="{{$unititem->purchasing_price}}" type="text"
                                                   placeholder="{{$unititem->purchasing_price}}"
                                                   class="form-control mr-2 col-xs-2">

                                            <div class="col-xs-2">
                                                @if($item['serial_multi'] == 1)
                                                    <button wire:click.prevent="addSerialnumber({{$unititem->id}})"
                                                            type="button"
                                                            class="btn btn-success">اضف الرقم
                                                        التسلسلي
                                                    </button>
                                                @else

                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            @if($serialNumbers->count() > 0)
                                                @foreach($serialNumbers->where('unit_id',$unititem->id) as $key => $serial)

                                                    <div class="row">
                                                        <div class="col-4 mt-2">
                                                            <lable> الرقم التسلسلي</lable>
                                                        </div>

                                                        <div class="col-4"><input
                                                                    wire:change="updateSerial({{$serial->id}})"
                                                                    wire:model.defer="serialNumbersUpdate.{{$serial->id}}"
                                                                    type="text" placeholder=""
                                                                    class="form-control mr-2">
                                                        </div>

                                                        <div class="col-4">
                                                            @if($serialNumbers->where('unit_id',$unititem->id)->count() > 1)
                                                                <button
                                                                        wire:click.prevent="removeSerialnumber({{$serial['id']}})"
                                                                        type="button" class="btn btn-danger">حذف
                                                                </button>
                                                            @endif
                                                        </div>

                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div wire:ignore.self class="tab-pane fade" id="nav-manufacturing{{$item['id']}}"
                             role="tabpanel" aria-labelledby="nav-manufacturing{{$item['id']}}-tab">
                            <table>
                                <thead>
                                <div class="row">
                                    <div class="col-2">الصنف</div>
                                    <div class="col-2">الكمية</div>
                                    <div class="col-2">السعر</div>
                                    <div class="col-2">اجمالي</div>
                                    <div class="col-2">#</div>

                                </div>
                                </thead>
                                <tbody>
                                @foreach($Manufacturings as $ManufacturingKey => $Manufacturing)
                                    @if(!empty($Manufacturing['id']))
                                        <div class="row">
                                            <div class="col-2">
                                                 <select wire:model="Manufacturings.{{$ManufacturingKey}}.item_id"
                                                        class="form-control form-control-sm" required>
                                                    <option value="">اختر الصنف</option>
                                                    @foreach(\App\Models\Item::get() as  $type)
                                                        <option {{ in_array($type->id,$ManufacturingsIDS) ? 'disabled' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2"><input
                                                        wire:model="Manufacturings.{{$ManufacturingKey}}.quantity"
                                                        type="text"
                                                        class="form-control form-control-sm"></div>
                                            <div class="col-2"><input
                                                        wire:model="Manufacturings.{{$ManufacturingKey}}.price"
                                                        type="text"
                                                        class="form-control form-control-sm"></div>
                                            <div class="col-2">
                                                <input
                                                        value="{{ $Manufacturings[$ManufacturingKey]['price']*$Manufacturings[$ManufacturingKey]['quantity'] }}"
                                                        disabled
                                                        type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-2">
                                                <button
                                                        wire:click.prevent="removeManufacturingnumber({{$Manufacturing['id']}})"
                                                        type="button" class="btn btn-danger">حذف
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div wire:ignore.self class="row">
                                    <div class="col-2">
                                        <button wire:ignore.self
                                                wire:click.prevent="addManufacturingNumber()" type="button"
                                                class="btn btn-success">اضف
                                        </button>
                                    </div>
                                </div>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button wire:click="update()" type="submit"
                                class="btn btn-primary">{{ __('Save') }}</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.
                    set('ottPlatform', data);
                });
            });
        </script>

    @endpush
</div>