<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm text-danger" data-bs-toggle="modal"
            data-bs-target=".exampleDeleteModal{{$payroll['id']}}">
        <i class="fa fa-trash"></i>
    </button>

    <!-- Modal -->
    <!-- wire:ignore.self -->
    <div class="modal fade exampleDeleteModal{{$payroll['id']}}" id="exampleModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0">
                    <span></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="modal-title text-primary border-bottom pb-3" id="exampleModalLabel">Delete payroll</h5>
                <div class="modal-body">
                    <p>{{__('Do you want to continue deleting this user ?')}}</p>
                    <div class="mb-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancel')}}</button>
                        <button wire:click.prevent="delete({{$payroll->id}})" type="button" class="btn btn-primary"
                                data-bs-dismiss="modal">{{ __('Yes')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>