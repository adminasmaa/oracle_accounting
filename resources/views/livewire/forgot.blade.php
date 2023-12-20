<div class="login vh-100">
    <div class="row justify-content-center h-100">
        <form wire:submit.prevent="send_reset" class="col-xl-4 col-lg-5 col-md-6 col-10 align-self-center">
            <div class="card card-body rounded-4">
                <div class="text-center py-3">
                    <img class="img-fluid" width="150" src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg')) }}" alt="logo">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control py-2 @error('email') is-invalid @enderror"
                           wire:model="email" id="Email" placeholder="{{ __('Email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-primary btn-login ps-4 pe-4"
                            type="submit">{{ __('Restore password') }}</button>
                </div>
                <div class="text-center mt-3 pt-2">
                    <a href="{{route('login')}}" class="btn text-primary">{{ __('Login') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
