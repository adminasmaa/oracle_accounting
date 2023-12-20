<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#000000"/>
    <link rel="icon" href="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!--load all styles for font aswesome -->
    <title>{{ config('app.name') }}</title>
    <!-- My own style -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
          integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @livewireStyles


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
<div class="container-fluid p-0 d-flex">
    <div class="d-lg-block sidebar pt-30p padding-bottom-76 border-0">
        <ul class="list-unstyled when-hover-side pt-4 bg-side-mobile">
            <li class="mb-2 px-3 text-center py-1">
                <a class="navbar-brand align-middle m-0" href="{{ route('home') }}">
                    <img class="pe-4" src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}" width="100" alt="">
                    {{--                        <span class="h5 d-lg-inline d-none">{{config("app.name")}}</span>--}}
                </a>
            </li>

            <!-- @if(auth()->user()->can('accounting show users'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('users') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                                   <i class="fas fa-user ml-1 h6"></i> {{ __('Users') }}
                </a>
           </li>

            @endif -->
            {{-- @if(auth()->user()->can('accounting show users')) --}}
            @foreach(\Spatie\Permission\Models\Role::whereIn('id', ['2', '3', '4'])->get() as $role)
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('users') }}?role_id={{ $role->id }}"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-user ml-1 h6"></i> @if($role->name == 'Admin')
                            الآدمن
                        @elseif($role->name ==
                                                'Supplier')
                            الموردين
                        @elseif($role->name == 'Customer')
                            الزبائن
                        @elseif($role->name ==
                                                'Employee')
                            الموظفين
                        @else
                            المستخدَمين
                        @endif
                    </a>
                </li>
            @endforeach
            {{-- @endif --}}
            {{--            @if(auth()->user()->can('accounting show roles'))--}}
            {{--                <li class="mb-2 px-3 py-1">--}}
            {{--                    <a href="{{ route('users.roles') }}" class="h5 text-decoration-none d-block
            mb-0">--}}
            {{--                        <i class="fas fa-user-shield ml-1 h6"></i> {{ __('Roles') }}--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}
            @if(auth()->user()->can('accounting show index accounts'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('index-accounts') }}"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-list ml-1 h6"></i> فهرس الحسابات
                    </a>
                </li>
            @endif
            <li class="mb-2 px-3 py-1">
                <a href="{{ route('limitations') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-list ml-1 h6"></i> القيود
                </a>
            </li>

            {{--            @if(auth()->user()->can('accounting show account guides'))--}}
            {{-- <li class="mb-2 px-3 py-1">
                            <a href="{{ route('account-guides') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
            <i class="fas fa-book ml-1 h6"></i> القوائم المالية
            </li> --}}
            {{-- @endif --}}
            @if(auth()->user()->can('accounting show items'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('items') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-th-list ml-1 h6"></i> الأصناف
                    </a>
                </li>
            @endif
            <li class="mb-2 px-3 py-1">
                <a href="{{ route('payrolls') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-file-invoice-dollar ml-1 h6"></i> كشوفات الرواتب
                </a>
            </li>

            @if(auth()->user()->can('accounting show invoices'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('invoices') }}?type=1"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-clipboard-list ml-1 h6"></i> فواتير الشراء
                    </a>
                </li>
            @endif


            @if(auth()->user()->can('accounting show invoices'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('invoices') }}?type=0"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-clipboard-list ml-1 h6"></i> فواتير البيع
                    </a>
                </li>
            @endif
            <li class="mb-2 px-3 py-1">
                <a href="{{ route('expenses') }}?type=3" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-clipboard-list ml-1 h6"></i> فواتير المصاريف
                </a>
            </li>

            <li class="mb-2 px-3 py-1">
                <a href="{{ route('revenues') }}?type=4" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-clipboard-list ml-1 h6"></i> الايرادات
                </a>
            </li>


            {{--            @if(auth()->user()->can('accounting show invoice items'))--}}
            {{--                <li class="mb-2 px-3 py-1">--}}
            {{--                    <a href="{{ route('invoice-items') }}" class="h5 text-decoration-none d-block
            mb-0">--}}
            {{--                        <i class="fas fa-stream ml-1 h6"></i> أصناف الفواتير--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}


            @if(auth()->user()->can('accounting show arrest receipts'))

                <li class="mb-2 px-3 py-1">

                    <a href="{{ route('arrest-receipts') }}?type=1"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">

                        <i class="fas fa-money-check-alt ml-1 h6"></i> سندات الصرف

                    </a>
                </li>

            @endif
            @if(auth()->user()->can('accounting show arrest receipts'))
                <li class="mb-2 px-3 py-1">
                    <a href="{{ route('arrest-receipts') }}?type=0"
                       class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                        <i class="fas fa-money-check-alt ml-1 h6"></i> ايصالات القبض
                    </a>
                </li>
            @endif

            <li class="mb-2 px-3 py-1">
                <a href="{{ route('invoices') }}?type=2"
                   class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-money-check-alt ml-1 h6"></i> مرجع بيع
                </a>
            </li>

            <li class="mb-2 px-3 py-1">
                <a href="{{ route('invoices') }}?type=3"
                   class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-money-check-alt ml-1 h6"></i> مرجع شراء
                </a>
            </li>


            {{--            @if(auth()->user()->can('accounting show invoice discounts'))--}}
            {{--                <li class="mb-2 px-3 py-1">--}}
            {{--                    <a href="{{ route('invoice-discounts') }}?type=1" class="h5 text-decoration-none
            d-block mb-0">--}}
            {{--                        <i class="fas fa-percent ml-1 h6"></i> خصومات الفواتير المكتسبة--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}
            {{--            @if(auth()->user()->can('accounting show invoice discounts'))--}}
            {{--                <li class="mb-2 px-3 py-1">--}}
            {{--                    <a href="{{ route('invoice-discounts') }}?type=0" class="h5 text-decoration-none
            d-block mb-0">--}}
            {{--                        <i class="fas fa-percent ml-1 h6"></i> خصومات الفواتير المسموح بها--}}
            {{--                    </a>--}}
            {{--                </li>
        {{--            @endif--}}
            {{-- @if(auth()->user()->can('accounting show settings')) --}}
            <li class="mb-2 px-3 py-1">
                <a href="{{ route('settings') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-cog ml-1 h6"></i> الاعدادات
                </a>
            </li>

            <li class="mb-2 px-3 py-1">
                <a href="{{ route('systemـconstants') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-cog ml-1 h6"></i> ثوابت النظام
                </a>
            </li>

            <li class="mb-2 px-3 py-1">
                <a href="{{ route('reports') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
                    <i class="fas fa-cog ml-1 h6"></i> تقرير الأرباح
                </a>
            </li>


            {{-- @endif --}}
            {{-- @if(auth()->user()->can('accounting show payrolls')) --}}
            {{-- <li class="mb-2 px-3 py-1">
                           <a href="{{ route('payrolls') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
            <i class="fas fa-file-invoice-dollar ml-1 h6"></i> كشوفات الرواتب
            </a>
            </li> --}}
            {{-- @endif --}}
            {{-- <li class="mb-2 px-3 py-1">
                            <a href="{{ route('categories') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
            <i class="fas fa-list ml-1 h6"></i> الأقسام
            </a>
            </li> --}}
            {{-- <li class="mb-2 px-3 py-1">
                            <a href="{{ route('units') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
            <i class="fas fa-box ml-1 h6"></i> الوحدات
            </a>
            </li> --}}
            {{-- <li class="mb-2 px-3 py-1">
                            <a href="{{ route('serial-numbers') }}" class="h5 text-decoration-none d-block mb-0 text-white pe-4">
            <i class="fas fa-lock ml-1 h6"></i> الأرقام التسلسلية
            </a>
            </li> --}}

        </ul>
    </div>
    <nav class="navbar position-absolute left-0 px-4 mt-2 z-index-40" style="width: 350px">
        <ul class="nav align-items-center justify-content-end w-100">
            @if(auth()->check())

                <li class="nav-item link-header-o">
                    <span class="badge bg-primary shadow-sm rounded">{{auth()->user()->roles()->pluck('name')->implode(',')}}</span>
                </li>
                <li class="nav-item link-header-o shadow-sm bg-white">
                    <a class="bg-white p-0" href="#" title="{{auth()->user()->name}}">
                        <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) :  (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg')) }}"
                             width="30" height="30" class="d-inline-block border rounded-circle bg-light" alt="">
                    </a>
                </li>
            @else
                <li class="nav-item link-header-o shadow-sm bg-white">
                    <a class="p-0 nav-link" href="#">
                        <img src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}" width="40px" height="40px"
                             class="d-inline-block border rounded-circle bg-light" alt="">
                        <span class="h6 text-dark">{{__("Guest")}}</span>
                    </a>
                </li>
            @endif
            @if(auth()->check())
                <li class="nav-item link-header-o shadow-sm bg-white">
                    <a href="{{route('logout')}}" class="nav-link p-0 text-primary" title="تسجيل خروج"><i
                                class="fas fa-sign-out-alt"></i></a>
                </li>
            @endif
            <li class="nav-item link-header-o shadow-sm bg-white d-lg-none">
                <button class="btn p-0 active-sidebar">
                    <i class="btn fas fa-bars p-0 rounded text-primary"></i>
                </button>
            </li>
        </ul>
        {{--                        <div class="col-md-2 mt-auto mb-auto text-start">--}}
        {{--                            <ul class="nav align-middle logout-sm">--}}
        {{--                            </ul>--}}
        {{--                        </div>--}}
    </nav>
    <div class="container-fluid position-relative bg-light rounded-4" style="min-height: 100vh">
        <div class="overlay"></div>
        <div class="main bg-side pt-30p padding-bottom-76 h-100">
            <div class="row h-100 g-0">
                <div class="col-md-12 px-0">
                    <h3 class="text-primary pb-4 border-bottom title-o">الديلاوي للمحاسبة</h3>
                    <div class="card bg-light rounded-4 border-0 p-md-3">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>

        <footer class="p-2 border-top position-absolute bottom-0 w-95 z-index-40">
            <h6>{{ __('All rights reserved to') }} <a href="" class="text-primary">Accounting</a></h6>
        </footer>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"
        integrity="sha512-t2JWqzirxOmR9MZKu+BMz0TNHe55G5BZ/tfTmXMlxpUY8tsTo3QMD27QGoYKZKFAraIPDhFv56HLdN11ctmiTQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@livewireScripts
@stack('scripts')
<script>
    window.addEventListener('close-modal', event => {
        $(".modal").modal('hide');
    })

    window.livewire.on('alertSuccess', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            'تهانينا 🙏 !',
            message,
            'success',
        )
    })

    window.livewire.on('alertFailed', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            'مع الأسف 😓 !',
            message,
            'error',
        )
    });
</script>


</body>

</html>