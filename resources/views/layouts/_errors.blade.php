@if(count($errors))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <strong>{{ $error }}</strong>
        <button type="button" class="close" data-dissmiss="alert" arial-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @endforeach
    </div>
@endif