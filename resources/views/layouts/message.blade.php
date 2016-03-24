    
@if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}">
        <strong>{{ Session::get('message') }}</strong>
    </div>
@endif