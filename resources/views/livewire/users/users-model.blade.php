<div class="d-inline me-2">
    <button type="button" class="btn btn-sm btn-outline-success px-2 py-1" data-bs-toggle="modal"
            data-bs-target="#modalFormEditUsersModel">
        <i class="fa fa-user"></i>
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormEditUsersModel" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-4 px-2">
                <div class="modal-header border-0 py-1">
                    <span></span>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="modal-title text-primary text-center border-bottom pb-3" id="exampleModalLabel">
                    المستخدمين</h5>
                @if($users->count())
                    <div class="row">
                        <div class="table-responsive-sm pb-3">
                            <table class="table table-striped table-responsive-sm border">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#20 20 20</th>
                                    <th scope="col" class="text-center">{{ __('Name') }}</th>
                                    <th scope="col" class="text-center">{{ __('Email') }}</th>
                                    <th scope="col" class="text-center">{{ __('Mobile') }}</th>
                                    <th scope="col" class="text-center">الرصيد</th>
                                    <th scope="col" class="text-center">{{ __('Roles') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center ">{{ $loop->iteration }}</td>
                                        <td class="text-center ">
                                            @if($user->name)
                                                <a href="{{ route('users.show', ['user_id' => $user->id]) }}">{{ $user->name }}</a>
                                            @else
                                                -
                                            @endif</td>
                                        <td class="text-center ">@if($user->email)
                                                {{ $user->email }}
                                            @else
                                                -
                                            @endif</td>
                                        <td class="text-center ">@if($user->mobile)
                                                {{ $user->mobile }}
                                            @else
                                                -
                                            @endif</td>
                                        <td class="text-center ">{{ $user->balance }}</td>
                                        <td class="text-center ">{{ $user->roles->pluck('name')->implode(',') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="mb-3 text-center fs-4 py-3">
                        <div><img width="200" src="{{ asset('assets/images/Error.png') }}" alt="">
                        </div>{{ __('Empty users') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
