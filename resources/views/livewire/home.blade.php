<div>
    @if(!auth()->user()->hasRole('Admin'))
        <h4 class="text-center mt-3 text-success pb-2"><a
                    href="{{ route('users.show', ['user_id' => auth()->id()]) }}">{{ __('Please fill in the rest of the information !') }}</a>
        </h4>
    @endif
    @if(auth()->user()->hasRole('Admin'))
        {{--        <h3 class="mt-3 text-primary">{{ __('Control Panel home page!') }}</h3>--}}
        <div class="row mt-3 mb-4 cases">
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-1.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-danger mb-0"> {{ __('Users number') }} </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\User::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-2.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-warning mb-0"> عدد الآدمن </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ $admins->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-3.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-success mb-0"> عدد الموردين </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ $suppliers->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-1.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-danger mb-0"> عدد الزبائن </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ $customers->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-4.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-success mb-0"> عدد الموظفين </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ $employees->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-5.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-warning mb-0"> عدد المستخدَمين </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ $servants->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-6.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-success mb-0">  {{ __('Roles number') }} </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \Spatie\Permission\Models\Role::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-7.png') }}" alt="">
                        </div>
                        <div class="col-8 px-0">
                            <h6 class="fw-bold text-success mb-0"> عدد فهارس الحسابات </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\IndexAccount::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-8.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-success mb-0"> عدد الأصناف </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\Item::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-9.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-success mb-0"> عدد فواتير البيع </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\Invoice::where('type', 0)->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-10.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-danger mb-0"> اجمالي فواتير البيع </h6>
                            <h2 class="fw-bolder text-black mb-0">
                                <!-- {{ \App\Models\Invoice::where('type', 0)->sum('sub_total') }} -->
                                {{ \App\Models\ArrestReceipt::where('type', 0)->sum('batch_quantity') }}
                            </h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-11.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-danger mb-0"> عدد فواتير الشراء </h6>
                            <h2 class="fw-bolder text-black mb-0">
                                {{ \App\Models\Invoice::where('type', 1)->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-12.png') }}" alt="">
                        </div>
                        <div class="col-8 align-self-center">
                            <h6 class="fw-bold text-danger mb-0"> اجمالي فواتير الشراء </h6>
                            <h2 class="fw-bolder text-black mb-0">
                                <!-- {{ \App\Models\Invoice::where('type', 1)->sum('sub_total') }} -->
                                <!-- <br> -->
                                {{ \App\Models\ArrestReceipt::where('type', 1)->sum('batch_quantity') }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-13.png') }}" alt="">
                        </div>
                        <div class="col-8 px-0">
                            <h6 class="fw-bold text-success mb-0"> عدد خصومات الفواتير </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\InvoiceDiscount::count() }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-14.png') }}" alt="">
                        </div>
                        <div class="col-8 px-0">
                            <h6 class="fw-bold text-success mb-0"> عدد ايصالات القبض الصادرة </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\ArrestReceipt::where('type', 0)->count() }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-3 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-4 g-1">
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('assets/images/icon-13.png') }}" alt="">
                        </div>
                        <div class="col-8 px-0">
                            <h6 class="fw-bold text-success mb-0"> عدد ايصالات القبض الواردة </h6>
                            <h2 class="fw-bolder text-black mb-0">{{ \App\Models\ArrestReceipt::where('type', 1)->count() }} </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
