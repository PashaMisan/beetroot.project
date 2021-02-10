@foreach($tables as $key => $table)

    @if(isset($table->order))

        @switch($table->getStatus())

            @case('Payment request')
            <tr class="payment">
                <td>{{ ++$key }}</td>
                <td>{{ $table->number  }}</td>
                <td>
                    <span class="mr-2"><span class="badge-dot badge-warning"></span>Payment request</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
            </tr>
            @break

            @case('Ordered')
            <tr class="ordered">
                <td>{{ ++$key }}</td>
                <td>{{ $table->number  }}</td>
                <td>
                    <span class="mr-2"><span class="badge-dot badge-warning"></span>Ordered</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
            </tr>
            @break

            @case('Call')
            <tr class="call">
                <td>{{ ++$key }}</td>
                <td>{{ $table->number  }}</td>
                <td>
                    <span class="mr-2"><span class="badge-dot badge-primary"></span>Call</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
            </tr>
            @break

            @default
            <tr class="">
                <td>{{ ++$key }}</td>
                <td>{{ $table->number  }}</td>
                <td>
                    <span class="mr-2"><span class="badge-dot badge-success"></span>Open</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
            </tr>
        @endswitch

    @else
        <tr class="">
            <td>{{ ++$key }}</td>
            <td>{{ $table->number  }}</td>
            <td><span class="mr-2"><span class="badge-dot badge-light"></span>Free</span></td>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
@endforeach
