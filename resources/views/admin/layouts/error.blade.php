@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>出错了! </strong>
        @foreach ($errors->all() as $error)
            <br> {{ $error }}.
        @endforeach
    </div>
@endif



