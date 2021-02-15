@foreach($sections as $section)
    <tr class="table-primary">
        <td colspan="7">{{ $section->name }}</td>
        <td>
            <a href="{{ route('products.create', ['section_id'=> $section->id]) }}"
               class="btn btn-rounded btn-light">Add new product</a>
        </td>

    </tr>
    @foreach($section->products as $key => $product)
        <tr>
            <td>{{ $product->position }}</td>
            <td>
                <a href="{{ route('products.show', ['id' => $product->id]) }}">{{ $product->name }}</a>
            </td>
            <td class=" text-truncate col-1"
                style="max-width: 100px;">{{ $product->description }}
            </td>

            {{--Ячейка отображения кнопок перемещения позиции---------------------}}
            <td class="p-0">
                <div class="d-flex justify-content-center mt-0">
                    <a href="javascript:void(0)"
                       class="f-icon"
                       onclick="changePosition({{ $product->position }}, {{ $product->section_id }}, true)">
                        <i class="fas fa-arrow-up"></i></a>
                    <a href="javascript:void(0)"
                       class="f-icon"
                       onclick="changePosition({{ $product->position }}, {{ $product->section_id }}, false)"><i
                            class="fas fa-arrow-down"></i></a>
                </div>
            </td>
            {{--------------------------------------------------------------------}}

            <td>{{ $product->weight }}</td>
            <td>{{ $product->price }}</td>
            <td>

                @if($product->status === 1)
                    <a href="javascript:void(0)" class="text-success"
                       id="product{{$product->id}}"
                       onclick="changeStatus({{$product->id}})">
                        On
                    </a>
                @else
                    <a href="javascript:void(0)" class="text-danger"
                       id="product{{$product->id}}"
                       onclick="changeStatus({{$product->id}})">
                        Off
                    </a>
                @endif

            </td>
            <td>
                <a href="{{ route('products.edit', ['id' => $product->id]) }}"
                   class="badge badge-primary m-1">Edit</a>

                <form class="m-1"
                    action="{{ route('products.destroy', ['id' => $product->id]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button class="badge badge-danger">Delete</button>
                </form>

            </td>
        </tr>
    @endforeach
@endforeach
