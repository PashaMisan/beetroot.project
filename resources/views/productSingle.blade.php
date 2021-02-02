@extends('layouts.html')

@section('content')
    <!-- ============================================================== -->
    <!-- Top of the page  -->
    <!-- ============================================================== -->
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url({{ asset('images/bg_3.jpg') }});"
             data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('main') }}">Home</a></span>
                            <span>Product Detail</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End top of the page  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Part of product description  -->
    <!-- ============================================================== -->
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('images/menu-2.jpg') }}" class="image-popup"><img
                            src="{{ asset('images/menu-2.jpg') }}" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>
                    <p class="price"><span>₴{{ $product->price }}</span></p>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->text }}</p>

                    @HasKey
                    <form action="{{ route('add_to_cart', ['product_id' => $product->id]) }}" method="POST"
                          id="form-id">
                        @csrf
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
                                <label for="quantity"></label><input type="text" id="quantity" name="quantity"
                                                                     class="form-control input-number" value="1"
                                                                     min="1" max="100">
                                <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button>
	             	</span>
                            </div>
                        </div>
                        <p><a href="javascript:void(0);" class="btn btn-primary py-3 px-5"
                              onclick="document.forms['form-id'].submit();">Add to Cart</a></p>
                    </form>
                    @endHasKey

                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End part of product description  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Part displays four random dishes  -->
    <!-- ============================================================== -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Related products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live
                        the blind texts.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img" style="background-image: url({{ asset('images/menu-1.jpg') }});"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            <p class="price"><span>$5.90</span></p>
                            <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img" style="background-image: url({{ asset('images/menu-2.jpg') }});"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            <p class="price"><span>$5.90</span></p>
                            <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img" style="background-image: url({{ asset('images/menu-3.jpg') }});"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            <p class="price"><span>$5.90</span></p>
                            <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img" style="background-image: url({{ asset('images/menu-4.jpg') }});"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            <p class="price"><span>$5.90</span></p>
                            <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- Part displays four random dishes  -->
    <!-- ============================================================== -->
@endsection

@section('scripts')
    <script src="{{ asset('js/productSingle/productSingle.js') }}"></script>
@endsection




