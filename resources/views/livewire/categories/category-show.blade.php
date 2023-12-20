<div class="text-center p-3">
    <h4>{{ $category->name }}</h4>
    @if($items->count())
        <div class="row mt-5">
            <div class="table-responsive-sm pb-3">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#55555</th>
                        <th scope="col" class="text-center">الاسم</th>
                        <th scope="col" class="text-center">الصورة</th>
                        <th scope="col" class="text-center">القسم</th>
                        <th scope="col" class="text-center">الوحدة</th>
                        <th scope="col" class="text-center">وحدة القياس</th>
                        <th scope="col" class="text-center">رمز الصنف</th>
                        <th scope="col" class="text-center">رقم تسلسلي</th>
                        <th scope="col" class="text-center">مكان التواجد</th>
                        <th scope="col" class="text-center">سعر البيع</th>
                        <th scope="col" class="text-center">سعر الشراء</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center ">{{ $loop->iteration }}</td>
                            <td class="text-center "><a
                                        href="{{ route('items.show', ['item_id' => $item->id]) }}">{{ $item->name }}</a>
                            </td>
                            <td class="text-center ">
                                @if($image = $item->attachments()->orderBy('id',"DESC")->first())
                                    <a href="{{ route('items.show', ['item_id' => $item->id]) }}">
                                        <img class="rounded border" width="70px" height="60px" alt="{{ $item->name }}"
                                             src="{{ url('storage/'.$image->path) }}" title="{{ $item->name }}">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center ">{{ $item->category ? $item->category->name : '-' }}</td>
                            <td class="text-center ">{{ $item->unit_id ? \App\Models\Unit::where('id', $item->unit_id)->first()->name : '-' }}</td>
                            <td class="text-center ">{{ \App\Models\Item::unitList($item->unit) }}</td>
                            <td class="text-center ">@if($item->item_number)
                                    {{ $item->item_number }}
                                @else
                                    -
                                @endif</td>
                            <td class="text-center ">@if($item->serial_number)
                                    {{ $item->serial_number }}
                                @else
                                    -
                                @endif</td>
                            <td class="text-center ">@if($item->place)
                                    {{ $item->place }}
                                @else
                                    -
                                @endif</td>
                            <td class="text-center ">{{ $item->selling_price }}</td>
                            <td class="text-center ">{{ $item->purchasing_price }}</td>
                            <td class="text-center ">
                                <livewire:items.item-edit :item_id="$item->id"
                                                          :key="'item-edit-category-show-'.$item->id"></livewire:items.item-edit>
                                <livewire:items.item-delete :item_id="$item->id"
                                                            :key="'item-delete-category-show-'.$item->id"></livewire:items.item-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $items->links() }}
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty items') }}
        </div>
    @endif
</div>
