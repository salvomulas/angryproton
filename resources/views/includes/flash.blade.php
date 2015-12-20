@if (Session::has('flash_message_type'))
    {{$message_type=Session::get('flash_message_type')}}
@else
    {{$message_type="success"}}
@endif

@if (Session::has('flash_message'))
    <div class="alert alert-{{$message_type}}">{{Session::get('flash_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
@endif

<script>
    $('div.alert').delay(4000).slideUp(300);
</script>