<div>
    <div class="row">
        <div class="col-5">
            <livewire:categories.category-create
                    :key="'category-create-categories-'"></livewire:categories.category-create>
        </div>
        {{--        <div class="col-7 text-start">--}}
        {{--            <form>--}}
        {{--                <div class="col-7 text-start d-inline-block">--}}
        {{--                    <input name="search" placeholder="البحث بالاسم أو رمز الصنف أو الرقم التسلسلي أو مكان التواجد" type="text" class="form-control" value="{{ $search }}">--}}
        {{--                </div>--}}
        {{--                <div class="col text-end d-inline-block">--}}
        {{--                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </div>

    @if($categories->count())
        <div class="row">
            <div class="table-responsive-sm pb-3">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#4444</th>
                        <th scope="col" class="text-center">الصورة</th>
                        <th scope="col" class="text-center">الاسم</th>
                        <th scope="col" class="text-center">الوصف</th>
                        <th scope="col" class="text-center">عدد الأصناف</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center ">{{ $loop->iteration }}</td>
                            <td class="text-center ">
                                @if($image = $category->attachments()->orderBy('id',"DESC")->first())
                                    <a href="{{ route('categories.show', ['category_id' => $category->id]) }}">
                                        <img class="rounded border" width="70px" height="60px"
                                             alt="{{ $category->name }}"
                                             src="{{ url('storage/'.$image->path) }}" title="{{ $category->name }}">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center "><a
                                        href="{{ route('categories.show', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                            </td>
                            <td class="text-center ">{{ $category->description }}</td>
                            <td class="text-center ">{{ $category->items ? $category->items->count() : '0' }}</td>
                            <td class="text-center ">
                                <livewire:categories.category-edit :category_id="$category->id"
                                                                   :key="'category-edit-categories-'.$category->id"></livewire:categories.category-edit>
                                <livewire:categories.category-delete :category_id="$category->id"
                                                                     :key="'category-delete-categories-'.$category->id"></livewire:categories.category-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty categories') }}
        </div>
    @endif
</div>

