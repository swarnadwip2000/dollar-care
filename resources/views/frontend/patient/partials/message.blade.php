<div class="row">
    @if(count($notifications) > 0)
    @foreach ($notifications as $notification)
    <div class="col-xl-12">
        <div class="notice-p">
            <p>{{nl2br($notification->message)}} </p>
        </div>
        <div class="notice-date">
            <h4>{{ date('d.m.y', strtotime($notification->created_at)) }} | {{ date('H.i A', strtotime($notification->created_at)) }}</h4>
        </div>
    </div>
    @endforeach
    <div>
        {{ $notifications->links() }}
    </div>
    @else
    <div class="col-xl-12">
        <div class="notice-p">
            <p>No Notification Found</p>
        </div>
    </div>
    @endif
</div>