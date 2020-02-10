<p>
    <a href="{{route('rateNotification',$notification->data['user_id'])}}">{{($notification->data['user_name'])}}</a> want to borrow {{$notification->data['title']}}<br>
    <a type='submit' href="{{'/approveNotification/'.$notification->data['user_id'].'/'.$notification->data['product_id']}}">Approve </a>

    <a type='submit' href="{{route('disapprove.notification',$notification->data['user_id'])}}">Disapprove</a>

</p>
