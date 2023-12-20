<div class="d-inline">

    <form wire:submit.prevent="update" class="modal-body">
        <div class="row mb-3">
            <div class="col-md-3 col-6">
                <div class="form-group">
                    <label for="" class="text-primary">تاريخ </label>
                    <input class="form-control" type="date" wire:model="payroll.date">
                </div>
            </div>
        </div>

        @foreach($payroll_item as $index=>$payroll)

            <div wire:ignore.self class="row ">
                <!-- <div class="form-group col-2">
                <label class=text-primary for="">رقم</label>
                <input wire:model.defer="payroll_item.{{$index}}.id" type="number" class="form-control" disabled>
                @error('payroll_item.advance')<span class="text-danger error">{{ $message }}</span>@enderror
                </div> -->

                <div class="form-group col-md-3 col-4 mb-3">
                    <label class="text-primary" for="">Employee</label>
                    <select wire:model="payroll_item.{{$index}}.user_id" :options="payroll_item.{{$index}}.user_id"
                            name="user_id" class="form-select" disabled>
                        <option value="">{{ __('Nothing') }}</option>
                        @foreach($users as $item)
                            <option {{old('user_id')==$item->id?'selected':''}} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('payrollitem.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2 col-4 mb-3">
                    <label class="text-primary" for="">الراتب</label>
                    <select wire:model="payroll_item.{{$index}}.user_id" :options="payroll_item.{{$index}}.user_id"
                            name="user_id" class="form-select" disabled>
                        <option value="">{{ __('Nothing') }}</option>
                        @foreach($users as $item)
                            <option {{old('user_id')==$item->id?'selected':''}} value="{{ $item->id }}">{{ $item->salary }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2 col-4 mb-3">
                    <label class="text-primary" for="">السلف</label>
                    <input wire:model.defer="payroll_item.{{$index}}.advance" type="number" class="form-control"
                           disabled>
                    @error('payroll_item.advance')<span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2 col-6 mb-3">
                    <label class="text-primary" for="">الدفع</label>
                    <input wire:model.defer="payroll_item.{{$index}}.paying_off" type="number" class="form-control">
                    @error('payroll_item.paying_off')<span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-3 col-6 mb-3">
                    <label class="text-primary" for="">الدفع التي تم دفعة</label>
                    <select wire:model="payroll_item.{{$index}}.id" :options="payroll_item.{{$index}}.id" name="id"
                            class="form-select" disabled>
                        @foreach($payrollitems as $payrollitem)
                            <option {{old('id')==$payrollitem->id?'selected':''}} value="{{ $payrollitem->id }}">{{ $payrollitem->paying_off }}</option>
                        @endforeach
                    </select>
                    <!-- @foreach($payrollitems as $payrollitem)
                        <input value="{{$payrollitem->paying_off}}" type="number" class="form-control">

                    @endforeach -->
                    @error('payroll_item.paying_off')<span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        @endforeach


        <div class="mt-4 text-end ">
            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary px-md-5">{{ __('Edit') }}</button>
        </div>
    </form>
</div>

<!-- <div class="d-inline">
    <button type="button" class="btn btn-sm text-primary border-end" data-bs-toggle="modal" data-bs-target=".modalFormEditPayroll{{$payroll['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditPayroll{{$payroll['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header">
                    <h5 class="modal-title">الأصناف</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label class=text-primary for="">المستخدم</label>
                        <select wire:model.defer="payroll.user_id" name="user_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>

@endforeach
</select>
@error('payroll.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label class=text-primary for="">السلفة</label>
    <input wire:model.defer="payroll.advance" type="number" class="form-control">
@error('payroll.advance')<span class="text-danger error">{{ $message }}</span>@enderror
</div>
<div class="mt-4">
    <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
