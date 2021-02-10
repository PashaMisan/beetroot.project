@extends('layouts.html')

@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('images/bg_3.jpg') }});"
             data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('main') }}">Home</a></span> <span>Menu</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @HasNotKey
    <section class="ftco-intro">
        <div class="container-wrap">
            <div class="wrap d-md-flex align-items-xl-end">
                <div class="info">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-phone"></span></div>
                            <div class="text">
                                <h3>000 (123) 456 7890</h3>
                                <p>A small river named Duden flows by their place and supplies.</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-my_location"></span></div>
                            <div class="text">
                                <h3>198 West 21th Street</h3>
                                <p> 203 Fake St. Mountain View, San Francisco, California, USA</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-clock-o"></span></div>
                            <div class="text">
                                <h3>Open Monday-Friday</h3>
                                <p>8:00am - 9:00pm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="book p-4">
                    <h3>Book a Table</h3>
                    <form action="#" class="appointment-form">
                        <div class="d-md-flex">
                            <div class="form-group">
                                <label>
                                    <input type="text" class="form-control" placeholder="First Name">
                                </label>
                            </div>
                            <div class="form-group ml-md-4">
                                <label>
                                    <input type="text" class="form-control" placeholder="Last Name">
                                </label>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <div class="input-wrap">
                                    <div class="icon"><span class="ion-md-calendar"></span></div>
                                    <label>
                                        <input type="text" class="form-control appointment_date" placeholder="Date">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group ml-md-4">
                                <div class="input-wrap">
                                    <div class="icon"><span class="ion-ios-clock"></span></div>
                                    <label>
                                        <input type="text" class="form-control appointment_time" placeholder="Time">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group ml-md-4">
                                <label>
                                    <input type="text" class="form-control" placeholder="Phone">
                                </label>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <label for=""></label><textarea name="" id="" cols="30" rows="2" class="form-control"
                                                                placeholder="Message"></textarea>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="submit" value="Appointment" class="btn btn-white py-3 px-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endHasNotKey

    @HasKey
    <section class="mt-2">

        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <p>
                        <a href="{{ route('waiter_call') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Call waiter</a>
                    </p>
                </div>

            </div>
        </div>

    </section>
    @endHasKey

    <section class="ftco-section">
        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    @foreach($menu as $key => $section)
                        @if($key%2 == 0)
                            <div class="mb-5 pb-3 ">
                                <h3 class="mb-5 heading-pricing ftco-animate">{{ $section->name }}</h3>

                                @foreach($section->products as $product)
                                    <div class="pricing-entry d-flex ftco-animate">
                                        <div class="img"
                                             style="background-image: url({{ asset('storage/'. $product->image) }});"></div>
                                        <div class="desc pl-3">
                                            <div class="d-flex text align-items-center">
                                                <h3>
                                                    <a href="{{ route('product_single', ['id' => $product->id]) }}"><span>{{ $product->name }}</span></a>
                                                </h3>
                                                <span class="price">₴{{ $product->price }}</span>
                                            </div>
                                            <div class="d-block">
                                                <p style="
                                                    overflow: hidden;
                                                    white-space: pre-line;
                                                    overflow-wrap: break-word;
                                                    ">{{ $product->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="col-md-6">

                    @foreach($menu as $key => $section)
                        @if($key%2 !== 0)
                            <div class="mb-5 pb-3 ">
                                <h3 class="mb-5 heading-pricing ftco-animate">{{ $section->name }}</h3>

                                @foreach($section->products as $product)
                                    <div class="pricing-entry d-flex ftco-animate">
                                        <div class="img"
                                             style="background-image: url({{ asset('storage/'. $product->image) }});"></div>
                                        <div class="desc pl-3">
                                            <div class="d-flex text align-items-center">
                                                <h3>
                                                    <a href="{{ route('product_single', ['id' => $product->id]) }}"><span>{{ $product->name }}</span></a>
                                                </h3>
                                                <span class="price">₴{{ $product->price }}</span>
                                            </div>
                                            <div class="d-block">
                                                <p style="
                                                    overflow: hidden;
                                                    white-space: pre-line;
                                                    overflow-wrap: break-word;
                                                    ">{{ $product->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach


                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- Menu with dish cards  -->
    <!-- ============================================================== -->
    <section class="ftco-menu mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Our Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts.</p>
                </div>
            </div>
            <div class="row d-md-flex">
                <div class="col-lg-12 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-5">
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab"
                                 role="tablist" aria-orientation="vertical">
                                <!-- ============================================================== -->
                                <!-- Section selection menu  -->
                                <!-- ============================================================== -->
                                @foreach($menu as $key => $section)
                                    <a class="nav-link {{ (!$key) ? 'active' : false }}" id="v-pills-{{ ++$key }}-tab"
                                       data-toggle="pill" href="#v-pills-{{ $key }}"
                                       role="tab" aria-controls="v-pills-{{ $key }}"
                                       aria-selected="true">{{ $section->name }}</a>
                            @endforeach
                            <!-- ============================================================== -->
                                <!-- End section selection menu  -->
                                <!-- ============================================================== -->
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                                <!-- ============================================================== -->
                                <!-- Displaying product cards  -->
                                <!-- ============================================================== -->
                                @foreach($menu as $key => $section)
                                    <div class="tab-pane fade {{ (!$key) ? 'show active' : false }}"
                                         id="v-pills-{{ ++$key }}" role="tabpanel"
                                         aria-labelledby="v-pills-{{ $key }}-tab">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- Display cards only for the selected section  -->
                                            <!-- ============================================================== -->
                                            @foreach($section->products as $product)
                                                <div class="col-md-4 text-center">
                                                    <div class="menu-wrap">
                                                        <a href="{{ route('product_single', ['id' => $product->id]) }}"
                                                           class="menu-img img mb-4"
                                                           style="background-image: url({{ asset('storage/'. $product->image) }});">
                                                            <span style="color: rgba(255,255,255,0)">Some hidden text for normal displaying of cards
                                                                Some hidden text for normal displaying of cards</span></a>
                                                        <div class="text">
                                                            <h3>
                                                                <a href="{{ route('product_single', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                            </h3>
                                                            <div>{{ $product->description }}
                                                            </div>
                                                            <p class="price"><span>₴{{ $product->price }}</span></p>
                                                            <p>
                                                                <a href="{{ route('product_single', ['id' => $product->id]) }}"
                                                                   class="btn btn-primary btn-outline-primary">
                                                                    See details
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        <!-- ============================================================== -->
                                            <!-- End display cards only for the selected section  -->
                                            <!-- ============================================================== -->

                                            <!-- ============================================================== -->
                                            <!-- Adding a single card for correct display  -->
                                            <!-- ============================================================== -->
                                            @if(count($section->products) == 1)
                                                <div class="col-md-4 text-center">
                                                    <div class="menu-wrap">
                                                        <div class="text">
                                                            <p style="color: rgba(255,255,255,0)">Far far away, behind
                                                                the word mountains, far from the countries
                                                                Vokalia and Consonantia.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                        <!-- ============================================================== -->
                                            <!-- End adding a single card for correct display  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                            @endforeach
                            <!-- ============================================================== -->
                                <!-- End displaying product cards  -->
                                <!-- ============================================================== -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End menu with dish cards  -->
    <!-- ============================================================== -->
@endsection
