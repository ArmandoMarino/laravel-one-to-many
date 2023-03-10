
@if (session('message'))
    <div class="alert alert-{{session('type') ?? 'info'}} mt-5">
        {{session('message')}}
    </div>
@endif