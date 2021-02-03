@foreach($tables as $key => $table)
    <tr class="{{ isset($table->order) && $table->getStatus() == 'Call' ? "call" : "" }}">
        <td>{{ ++$key }}</td>
        <td>{{ $table->number  }}</td>

        @if(isset($table->order))

            @switch($table->getStatus())
                @case('Call')
                <td>
                    <span class="mr-2"><span class="badge-dot badge-primary"></span>Call</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
                @break

                @default
                <td>
                    <span class="mr-2"><span class="badge-dot badge-success"></span>Open</span>
                </td>
                <td>{{ $table->getWaiterName()}}</td>
                <td>{{ $table->order->created_at }}</td>
            @endswitch

        @else

            <td><span class="mr-2"><span class="badge-dot badge-light"></span>Free</span></td>
            <td>-</td>
            <td>-</td>

        @endif

    </tr>
@endforeach
