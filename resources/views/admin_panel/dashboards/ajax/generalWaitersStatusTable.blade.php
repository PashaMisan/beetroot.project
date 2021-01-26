@foreach($waiters as $waiter)
    <tr>
        <td>{{ $waiter->name }}</td>
        <td>

            @if($waiter->isOnline())
                <span class="mr-2"><span class="badge-dot badge-success"></span>Online</span>
            @else
                <span class="mr-2"><span class="badge-dot badge-danger"></span>Offline</span>
            @endif

        </td>
    </tr>
@endforeach
