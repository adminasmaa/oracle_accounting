<div class="d-inline">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalFormUser">
        @if(!$role_id)
            {{ __('Create user') }}
        @else
            {{ __('Create '. \Spatie\Permission\Models\Role::where('id', $role_id)->first()->name) }}
        @endif
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormUser" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="border-bottom">
                    <h5 class="text-primary text-center" id="exampleModalLabel">@if($role_id)
                            {{ __(\Spatie\Permission\Models\Role::where('id', $role_id)->first()->name.'s') }}
                        @endif </h5>
                </div>
                <form wire:ignore.self wire:submit.prevent="store" class="modal-body row g-1 text-primary">
                    <div class="form-group col-6">
                        <label for="">الاسم</label>
                        <input wire:model.defer="user.name" type="text" class="form-control">
                        @error('user.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    @if($role_id == 4)
                        <div class="form-group col-6">
                            <label for="">الراتب</label>
                            <input wire:model.defer="user.salary" type="number" class="form-control">
                            @error('user.salary')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    @endif
                    <div class="form-group col-6">
                        <label for="">رقم الهوية</label>
                        <input wire:model.defer="user.id_number" type="number" class="form-control">
                        @error('user.id_number')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="">رقم الحساب البنكي</label>
                        <input wire:model.defer="user.bank_account_number" type="number" class="form-control">
                        @error('user.bank_account_number')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">اسم البنك</label>
                        <input wire:model.defer="user.bank_name" type="text" class="form-control">
                        @error('user.bank_name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('Email') }}</label>
                        <input wire:model.defer="user.email" type="email" class="form-control">
                        @error('user.email')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('Mobile') }}</label>
                        <input wire:model.defer="user.mobile" type="number" class="form-control">
                        @error('user.mobile')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">العنوان</label>
                        <input wire:model.defer="user.address" type="text" class="form-control">
                        @error('user.address')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    {{--                    <div class="form-group col-6">--}}
                    {{--                        <label for="">الرصيد</label>--}}
                    {{--                        <input wire:model.defer="user.balance" type="number" class="form-control">--}}
                    {{--                        @error('user.balance')<span class="text-danger error">{{ $message }}</span>@enderror--}}
                    {{--                    </div>--}}

                    {{-- <div class="form-group col-6">
                        <label for="">المسمى الوظيفي</label>
                        <input wire:model.defer="user.job" type="text" class="form-control">
                        @error('user.job')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div> --}}
                    <div class="form-group col-6">
                        <label for="">القسم</label>
                        <input wire:model.defer="user.section" type="text" class="form-control">
                        @error('user.section')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>


                    <!-- @if(! $role_id)
                        <div class="form-group col-6">
                            <label for="">{{ __('Roles') }}</label>
                            <select wire:model.defer="user.role_id" multiple name="role_id" class="form-control">
                                <option value="">لا يوجد</option>
                                @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                        @endforeach
                        </select>
@error('user.role_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                    @endif -->
                    {{--                    <div class="form-group col-6">--}}
                    {{--                        <label for="">{{ __('Password') }}</label>--}}
                    {{--                        <input wire:model.defer="user.password" type="password" class="form-control">--}}
                    {{--                        @error('user.password')<span class="text-danger error">{{ $message }}</span>@enderror--}}
                    {{--                    </div>--}}
                    <div class="col-12 align-self-end text-center mt-3">
                        <button wire:loading.attr="disabled" type="submit"
                                class="btn btn-primary w-50 py-2">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
