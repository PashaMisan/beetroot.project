@if($orders)
    @foreach($orders as $order)
        <tr class="text-center">
            <td class="product-remove"><a href="javascript:void(0);"
                                          onclick="tableUpdate({{ $order['product']->id }},
                                              '{{ route('remove_product_ajax') }}')"><span
                        class="icon-close"></span></a></td>
            <td class="image-prod">
                <div class="img"
                     style="background-image:url({{ asset('images/menu-2.jpg') }});"></div>
            </td>
            <td class="product-name">
                <h3>{{ $order['product']->name }}</h3>
                <p>{{ $order['product']->description }}</p>
            </td>
            <td class="price">₴{{ $order['product']->price }}</td>
            <td class="quantity">
                <div class="input-group mb-3">
                    <label>
                        <input type="text" name="quantity"
                               class="quantity form-control input-number"
                               value="{{ $order[0]}}" min="1"
                               max="100"
                               oninput="tableUpdate({{ $order['product']->id }}, '{{ route('full_price_ajax') }}', value)">
                    </label>
                </div>
            </td>
            <td class="total">₴<span id="fullPrice{{ $order['product']->id }}">{{ $order['fullPrice'] }}</span></td>
        </tr>
    @endforeach
@else
    <tr class="text-center">
        <td class="product-name" colspan="6">
            <p>Your cart is currently empty.</p>
        </td>
    </tr>
@endif
