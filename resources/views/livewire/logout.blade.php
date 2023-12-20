<div>
    <div class="row justify-content-center px-4 py-2 mt-4">
        <div class="col-md-12 text-center mb-5">
            <div class="pe-5 pb-5 title-login">
                <h3>{{ __('Hey, you ..') }}</h3>
                <h1 class="text-primary">
                    Accounting</h1>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="card mb-3 shadow-sm border-0 rounded-3">
                <div class="card-body ">
                    <div class="text-center mb-3">
                        <img width="250" src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}" class="img-fluid" alt="">
                    </div>
                    <div class="text-center my-2">
                        <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-3 mb-3"><i
                                    class="fas fa-home pe-1"></i>{{ __('Back to home') }}</a>
                    </div>
                    <div class="text-center my-2">
                        <a href="" class="btn btn-primary rounded-pill px-3 mb-3" wire:click.prevent="logout"><i
                                    class="fas fa-sign-out-alt pe-1"></i>{{ __('Logout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
