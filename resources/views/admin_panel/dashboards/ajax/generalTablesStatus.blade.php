@foreach($tables as $key => $table)
<tr>
    <td>{{ ++$key }}</td>
    <td>{{ $table->number  }}</td>

    @if($table->order)
    <td>
                                    <span class="mr-2">
                                        <span class="badge-dot badge-success"></span>{{ $table->getStatus() }}</span>
    </td>
    <td>{{ $table->getWaiterName()}}</td>
    <td>{{ $table->order->created_at }}</td>
    @else
    <td>
        <span class="mr-2"><span class="badge-dot badge-warning"></span>Free</span></td>
    <td>-</td>
    <td>-</td>
    @endif

</tr>
@endforeach
