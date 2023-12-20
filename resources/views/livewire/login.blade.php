<div class="login vh-100">
    <div class="row justify-content-center h-100">
        <form wire:submit.prevent="login" class="col-xl-4 col-lg-5 col-md-6 col-10 align-self-center">
            <div class="card card-body rounded-4">
                <div class="text-center py-3">
                    <img class="img-fluid" width="150" src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}" alt="logo">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control py-2 @error('user.email') is-invalid @enderror"
                           wire:model="user.email" id="Email" placeholder="{{ __('Email') }}">
                    @error('user.email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" wire:model="user.password"
                           class="form-control py-2 @error('user.password') is-invalid @enderror" id="password"
                           placeholder="{{ __('Password') }}">
                    @error('user.password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn w-50 btn-primary">{{ __('Login') }}</button>
                </div>
                <div class="text-primary text-center py-3 my-2">
                    <h5><a href="{{ route('forgot') }}"
                           class="text-primary ">{{ __('did you forget your password ?') }}</a></h5>
                </div>
            </div>
        </form>
    </div>
</div>
