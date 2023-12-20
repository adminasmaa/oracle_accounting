<div class="d-inline">
    {{--    @if(auth()->user()->can('delete users'))--}}
    <button type="button" class="btn btn-sm text-danger border-end" data-bs-toggle="modal"
            data-bs-target=".modalFormDeleteUser{{$user->id}}">
        <i class="fa fa-trash"></i>
    </button>
    <div wire:ignore.self class="modal fade modalFormDeleteUser{{$user->id}}" id="" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="modal-title text-primary border-bottom pb-3" id="exampleModalLabel">{{ __('Users') }}</h5>
                <div class="modal-body">
                    <p>{{ __('Do you want to continue deleting this user ?') }}</p>
                    <div class="mt-4">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"
                                class="btn btn-light px-2">{{ __('Cancel') }}</button>
                        <button type="button" wire:click.prevent="delete"
                                class="btn btn-primary px-2">{{ __('Yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    @endif--}}
</div>

