<div class="d-inline">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        {{__('قائمة الأصناف')}}
    </button>

    <form wire:submit.prevent="store" class="modal-body">

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 px-2">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"> {{__('قائمة التصنيفات')}}</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <table class="table table-responsive-md table-borderless">
                        <thead>
                        <th colspan="5">
                            <div class="d-flex">
                                <input class="form-control" wire:model="search" type="text">
                                <span class="btn btn-primary rounded mx-1"><i class="fa-solid fa-magnifying-glass"></i> </span>
                            </div>
                        </th>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">name</div>
                            </th>
{{--                            <th scope="col" class="text-center p-1">--}}
{{--                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">pieces</div>--}}
{{--                            </th>--}}
{{--                            <th scope="col" class="text-center p-1">--}}
{{--                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">selling_price</div>--}}
{{--                            </th>--}}
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">Choose</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $keys=>$unit)
                            <tr>
                                <th class="text-center p-1" scope="row">
                                    <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$unit->id}}</div>
                                </th>
                                <td class="text-center p-1">
                                    <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$unit->name}}</div>
                                </td>
{{--                                <td class="text-center p-1">--}}
{{--                                    <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$unit->pieces}}</div>--}}
{{--                                </td>--}}
{{--                                <td class="text-center p-1">--}}
{{--                                    <div class="shadow-sm rounded-2 py-2 min-h-40p">{{$unit->selling_price}}</div>--}}
{{--                                </td>--}}
                                <td class="text-center p-1">
                                    <div class="shadow-sm rounded-2 py-2 min-h-40p">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input cbActiveemail" type="checkbox" name="ids"
                                                   value="{{$unit->id}}" wire:click="InvoiceSelectedUnit({{$unit}})"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" style="background-color: #478fcc;color:white"
                                class="btn">{{ __('Add') }}</button>

                    </div>
                </div>
            </div>
        </div>


    </form>
</div>