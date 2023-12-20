<div>
    <div class="row mb-2">
        <div class="col-md-5">
            <livewire:users.user-create :key="'user-create-users-'"></livewire:users.user-create>
        </div>
        <div class="col-md-7 text-start">
            <form class="row g-1">
                <div class="col-md-11 col-10 text-start">
                    <input name="search" placeholder="البحث بالاسم أو البريد أو الهاتف" type="text" class="form-control"
                           value="{{ $search }}">
                </div>
                <div class="col-md-1 col-2 text-end d-inline-block pe-1">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($users->count())
        <div class="row">
            <div class="table-responsive-sm pb-3">
                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">#</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Name') }}</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Email') }}</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Mobile') }}</div>
                        </th>
                        <th scope="col" class="text-center p-1">
                            <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الرصيد</div>
                        </th>
                        @if(request('role_id') == 4)

                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">الراتب</div>
                            </th>

                        @endif

                        @if(auth()->user()->hasRole('Admin'))
                            <th scope="col" class="text-center p-1 ">
                                <div class="bg-primary rounded-2 text-white p-1 min-h-40p">{{ __('Control') }}</div>
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($users as $user)

                        @php
                            $arrest = 0
                        @endphp
                        @foreach($user->arrest_receipts as $use)
                            @php
                                $arrest = $arrest + $use->batch_quantity;
                            @endphp
                        @endforeach
                        @php
                            $total = 0;
                            $discount = 0 ;
                            foreach($user->invoice_items as $item){



                                $total = $total + ($item->quantity *  $item->unit->selling_price);

                            }
                            foreach($user->invoice_discounts as $get_descount){
                               $discount = $discount + ($get_descount->discount_quantity);


                            }

                        @endphp




                        <tr>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 p-1 min-h-40p">{{ $loop->iteration }}</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($user->name)
                                        <a href="{{ route('users.show', ['user_id' => $user->id]) }}">{{ $user->name }}</a>
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($user->email)
                                        {{ $user->email }}
                                    @else
                                        -
                                    @endif</div>
                            </td>
                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 p-1 min-h-40p">@if($user->mobile)
                                        {{ $user->mobile }}
                                    @else
                                        -
                                    @endif</div>
                            </td>

                            <td class="text-center align-middle px-1 py-0">
                                <div class="bg-white rounded-2 p-1 min-h-40p"> {{ $user->payrolls->sum('paying_off') - $user->payrolls->sum('salary')  + $user->total_price  }}</div>
                            </td>

                            @if(request('role_id') == 4)
                                <td class="text-center align-middle px-1 py-0">
                                    <div class="bg-white rounded-2 p-1 min-h-40p">{{ $user->salary }}</div>
                                </td>
                            @endif


                            @if(auth()->user()->hasRole('Admin'))
                                <td class="text-center align-middle px-1 py-1">
                                    <div class="bg-white rounded-2 py-1">
                                        <livewire:users.user-edit :user_id="$user->id"
                                                                  :key="'user-edit-users-'.$user->id"></livewire:users.user-edit>
                                        <livewire:users.user-delete :user_id="$user->id"
                                                                    :key="'user-delete-users-'.$user->id"></livewire:users.user-delete>
                                        <button wire:click="viewreport({{$user->id}})" type="button"
                                                class="btn btn-sm border-end"
                                                data-bs-toggle="modal" data-bs-target="#modalFormviewReport">
                                            <i class="fa fa-file"></i>
                                        </button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    @else
        <div class="mb-3 text-center fs-4 py-3">
            <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt=""></div>{{ __('Empty users') }}
        </div>
    @endif
    {{--    @endif--}}
</div>

