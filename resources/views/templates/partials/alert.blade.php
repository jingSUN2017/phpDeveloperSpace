@if(Session::has('info'))
    <div class="alert">
        {{Session::get('info')}}
    </div>
@endif