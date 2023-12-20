<div>
    <div>
        <div class="row">
            <div class="col-md-5">
                <div class="d-flex">
                    <livewire:items.item-create :key="'item-create-items-'"></livewire:items.item-create>

                    {{-- <a href="{{ route('categories') }}" class="btn btn-info mb-3">
                    <i class="fas fa-list ml-1 h6"></i> الأقسام
                    </a> --}}
                </div>
                <div class="">
                    <button wire:click="reports()" type="button" class="btn btn-primary mx-1">
                        <i class="fa fa-file"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-7 text-end">
            <form class="row g-0 justify-content-start">
                <div class="col-11">
                    <input name="search" placeholder="البحث بالاسم أو رمز الصنف أو الرقم التسلسلي أو مكان التواجد"
                           type="text" class="form-control" value="{{ $search }}">
                </div>
                <div class="col-1 text-end d-inline-block">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive-sm pb-3">
            @if($items)
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الاسم</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الصورة</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">القسم</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الوحدة</div>
                        </th>

                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رمز الصنف</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">رقم تسلسلي</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">مكان التواجد</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">متعدد السيريال</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    <a wire:click="itemreport({{$item->id}})" href="#">{{ $item->name }}</a>
                                </div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    @if($image = $item->attachments()->orderBy('id',"DESC")->first())
                                        <a href="{{ route('items.show', ['item_id' => $item->id]) }}">
                                            <img class="rounded border" width="70px" height="60px"
                                                 alt="{{ $item->name }}"
                                                 src="{{ url('storage/'.$image->path) }}" title="{{ $item->name }}">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">{{ $item->category ? $item->category->name : '-' }}</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    @foreach($item->unit_item as $ite)
                                        {{$ite->unit->name }}
                                    @endforeach
                                </div>
                            </td>
                            {{-- <td class="text-center align-middle px-1 py-0">{{ \App\Models\Item::unitList($item->unit) }}</</td>
                            --}}
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">@if($item->item_number)
                                        {{ $item->item_number }}
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    @if($item->serial_numbers->count())
                                        @foreach($item->serial_numbers as $serial_number)
                                            <li class="text-end me-5">{{ $serial_number->serial }}</li>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">@if($item->place)
                                        {{ $item->place }}
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">@if($item->serial_multi == 0)
                                        لا
                                    @else
                                        نعم
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 py-2 min-h-40p">
                                    {{--                                    <livewire:units.unit-create :item_id="$item->id" :key="'unitsss-unitss-create-'.$item->id">--}}
                                    {{--                                    </livewire:units.unit-create>--}}
                                    <livewire:items.item-edit :item_id="$item->id" :key="'item-edit-items-'.$item->id">
                                    </livewire:items.item-edit>
                                    <livewire:items.item-delete :item_id="$item->id"
                                                                :key="'item-delete-items-'.$item->id">
                                    </livewire:items.item-delete>
                                    <button wire:click="itemreport({{$item->id}})" type="button"
                                            class="btn btn-sm text-success " data-bs-toggle="modal"
                                            data-bs-target="#modalFormitemReport">
                                        <i class="fa fa-file"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {{ $items->links() }}
            @else
                <div class="mb-3 text-center fs-4 py-3">
                    <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                    </div>{{ __('Empty items') }}
                </div>
            @endif
        </div>
    </div>
</div>