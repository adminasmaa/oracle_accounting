<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        {{__('قائمة التصنيفات')}}
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
{{--                        <th scope="col">pieces</th>--}}
{{--                        <th scope="col">selling_price</th>--}}
                        <th scope="col">Choose</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $units)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$units->name}}</td>
{{--                            <td>{{$units->pieces}}</td>--}}
{{--                            <td>{{$units->selling_price}}</td>--}}
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input cbActiveemail" type="checkbox" name="ids"
                                           wire:model="event.{{$units->id}}" value="{{$units->id}}"/>
                                </div>
                            </td>
                            <!-- <div>@json($event)</div> -->
                            <!-- wire:click="selectUnit({{$units->id}})" -->
                            <!-- <td><button type="button" wire:click="selectUser({{$units->id}})">اختيار</button></td> -->
                        </tr>
                    @endforeach
                    <button wire:click="selectUnit($event)">
                        save
                    </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>