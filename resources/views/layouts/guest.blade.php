<!doctype html>
<html lang="en" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#000000"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>    <!--load all styles for font aswesome -->
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
</head>

<body>
<div class="container-fluid p-0 d-flex">
    {{--    <nav class="navbar fixed-top navbar-light bg-white border-bottom">--}}
    {{--        <div class="row w-100">--}}
    {{--            <div class="col-md-3 d-sm-block d-inline-block text-center text-md-end">--}}
    {{--                <a class="navbar-brand align-middle m-0" href="#">--}}
    {{--                    <img src="{{ (($logo = \App\Models\Setting::where("id",(session('site_id') ? session('site_id') : 1) )->first())? ( $logo->attachment?url("storage/".$logo->attachment->path): asset('assets/images/logo-white.svg')) :asset('assets/images/logo-white.svg'))}}" width="50px" alt="">--}}
    {{--                    <span class="h5 d-lg-inline d-none">{{config("app.name")}}</span>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="position-absolute active-sidebar d-sm-none">--}}
    {{--            <i class="btn fas fa-bars border p-2 rounded bg-light text-primary"></i>--}}
    {{--        </div>--}}
    {{--    </nav>--}}
    <div class="container-fluid g-0">
        <div class="">
            <div class="row">
                <div class="col-md-12 h-100">
                    <div class="  ">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>

        {{--        <footer class="p-2 border-top position-absolute bottom-0 w-95 z-index-40 z-index-40">--}}
        {{--            <h6>{{ __('All rights reserved to') }}  <a href="" class="text-primary">Accounting</a></h6>--}}
        {{--        </footer>--}}
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"
        integrity="sha512-t2JWqzirxOmR9MZKu+BMz0TNHe55G5BZ/tfTmXMlxpUY8tsTo3QMD27QGoYKZKFAraIPDhFv56HLdN11ctmiTQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@livewireScripts

<script>
    window.addEventListener('close-modal', event => {
        $(".modal").modal('hide');
    })

    window.livewire.on('alertSuccess', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            'تهانينا 🙏 !',
            ' 🎉🎊 !'+message,
            'success',
        )
    })

    window.livewire.on('alertFailed', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            'مع الأسف 😓 !',
            ' 😓 !'+message,
            'error',
        )
    })
</script>

</body>
</html>
