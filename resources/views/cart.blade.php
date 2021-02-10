@extends('layouts.html')

@section('content')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url({{ asset('images/bg_3.jpg') }});"
             data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Cart</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('main') }}">Home</a></span> <span>Cart</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody id="table-cart">
                            <!-- ============================================================== -->
                            <!-- Withdrawing orders  -->
                            <!-- ============================================================== -->
                            @include('ajax.tables.cart')
                            <!-- ============================================================== -->
                            <!-- End withdrawing orders  -->
                            <!-- ============================================================== -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>₴<a id="totalPrice">{{ $totalPrice }}</a></span>
                        </p>
                    </div>
                    <p class="text-center"><a href="{{ route('confirm') }}" class="btn btn-primary py-3 px-4">Confirm
                            this order</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <h2 class="mb-3 text-center">Your cart story</h2>
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Status</th>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody id="table-cart">

                            @if($cartStory)
                                @foreach($cartStory['productArr'] as $product)
                                    <tr class="text-center">
                                        <td class="price">{{ $product['condition'] }}</td>
                                        <td class="image-prod">
                                            <div class="img"
                                                 style="background-image:url({{ asset('storage/'. $product['image']) }});"></div>
                                        </td>
                                        <td class="product-name">
                                            <h3>{{ $product['name'] }}</h3>
                                        </td>
                                        <td class="price">₴{{ $product['price'] }}</td>
                                        <td class="quantity">{{ $product['quantity'] }}</td>
                                        <td class="total">₴{{ $product['fullPrice'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td class="product-name" colspan="6">
                                        <p>Your cart story is currently empty.</p>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>For payment</h3>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>₴<a id="totalPrice">{{ $cartStory['sum'] }}</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Related products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts.</p>
                </div>
            </div>
            <div class="row">

                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="{{ route('product_single', ['id' => $product->id]) }}" class="img"
                               style="background-image: url({{ asset('storage/'. $product->image) }});"></a>
                            <div class="text text-center pt-4">
                                <h3><a href="#">{{ $product->name }}</a></h3>
                                <p>{{ $product->description }}</p>
                                <p class="price"><span>₴{{ $product->price }}</span></p>
                                <p><a href="{{ route('product_single', ['id' => $product->id]) }}"
                                      class="btn btn-primary btn-outline-primary">See details
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var csrf = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/productSingle/productSingle.js') }}"></script>
    <script src="{{ asset('js/helpers/fetch.js') }}"></script>
    <script src="{{ asset('js/cart/ajax.js') }}"></script>
@endsection
