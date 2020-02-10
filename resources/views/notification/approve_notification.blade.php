<p>
{{($notification->data['user_name'])}} has approve your request<br>
<form action="{{route('send.message',$notification->data['user_id'])}}" method="post">
@csrf
<textarea  @keydown.enter="send" placeholder="Message..." name="text" id="text"></textarea>
<button type="submit">send</button>
</form>

</a>
</p>