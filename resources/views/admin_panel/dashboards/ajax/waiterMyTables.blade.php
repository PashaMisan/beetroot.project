@foreach($waiterTables as $key => $table)

    @switch($table->getStatus())

        @case('Ordered')
        <tr class="bg-brand ordered">
            <td>{{ ++$key }}</td>
            <td>{{ $table->number  }}</td>
            <td>
                <span class="mr-2"><span class="badge-dot badge-warning">
                                    </span>{{ $table->getStatus() }}</span>
            </td>
            <td>{{ $table->getWaiterName()}}</td>
            <td>{{ $table->order->created_at }}</td>
            <td>
                <a href="{{ route('carts.index', ['id' => $table->order->id]) }}"
                   class="btn btn-light">View</a>
            </td>
        </tr>
        @break

        @case('Call')
        <tr class="bg-info call">
            <td>{{ ++$key }}</td>
            <td>{{ $table->number  }}</td>
            <td>
                <span class="mr-2"><span class="badge-dot badge-primary">
                                    </span>{{ $table->getStatus() }}</span>
            </td>
            <td>{{ $table->getWaiterName()}}</td>
            <td>{{ $table->order->created_at }}</td>
            <td>
                <a href="{{ route('accept_table', ['id' => $table->id]) }}"
                   class="btn btn-light">Accept</a>
            </td>
        </tr>
        @break

        @default
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $table->number  }}</td>
            <td>
                                <span class="mr-2"><span class="badge-dot badge-success">
                                    </span>{{ $table->getStatus() }}</span>
            </td>
            <td>{{ $table->getWaiterName()}}</td>
            <td>{{ $table->order->created_at }}</td>
            <td>
                <a href="{{ route('close_table', ['id' => $table->id]) }}"
                   class="btn btn-outline-danger">Close</a>
                <a href="{{ route('set_key', ['table_key' => $table->order->key]) }}"
                   class="btn btn-outline-success">QR</a>
            </td>
        </tr>
    @endswitch

@endforeach


