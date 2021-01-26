@extends('layouts.html')

@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                        <p>
                            <span class="p-2">{{ $qr }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

