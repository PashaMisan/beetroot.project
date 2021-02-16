@extends('admin_panel.layouts.panel')

@section('content')

    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel
                                mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                       class="breadcrumb-link">Dashboard</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->


                @ForWaiter
                <!-- ============================================================== -->
                <!-- Waiter dashboard  -->
                <!-- ============================================================== -->
                <div class="row">
                    @include('admin_panel.dashboards.waiter')
                </div>
                <!-- ============================================================== -->
                <!-- End waiter dashboard  -->
                <!-- ============================================================== -->
                @endForWaiter

                <!-- ============================================================== -->
                <!-- General dashboard  -->
                <!-- ============================================================== -->
                <div class="row">
                    @include('admin_panel.dashboards.general')
                </div>
                <!-- ============================================================== -->
                <!-- End general dashboard  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
@endsection

@section('JavaScripts')
    <script>
        //Скрипт собирает все элементы с классом payment и выделяет их мигающими цветом
        setInterval(() =>
            document.querySelectorAll(".payment").forEach(element => element.classList.toggle("bg-secondary")
            ), 700)

        //Скрипт собирает все элементы с классом call и выделяет их мигающими цветом
        setInterval(() =>
            document.querySelectorAll(".call").forEach(element => element.classList.toggle("bg-info")
            ), 700)

        //Скрипт собирает все элементы с классом ordered и выделяет их мигающими цветом
        setInterval(() =>
            document.querySelectorAll(".ordered").forEach(element => element.classList.toggle("bg-brand")
            ), 700)

        //Необходимые переменные для Ajax запроса
        let csrf = '{{ csrf_token() }}';
        let dataTime = {!! $last_change_of_orders !!};
        let route = '{{ route('main_page_ajax') }}';
    </script>
    <script src="{{ asset('js/helpers/fetch.js') }}"></script>
    <script src="{{ asset('admin_panel/main_page/main_page.js') }}"></script>
@endsection


