@if ($message = Session::get('success'))
    <div class="aler alert-success alert-dismissble show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            {{ $message }}
        </div>

    </div>
@endif
