@if(Session::has('message'))
     {{-- <div class="" ss="alert alert-success alert-dismissible">{{ Session::get('message') }}</div> --}}
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::has('error_message'))
     {{-- <div class="alert alert-danger">{{ Session::get('error_message') }}</div> --}}
     <div class="alert alert-danger alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         {{ Session::get('error_message') }}
     </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
@endif --}}