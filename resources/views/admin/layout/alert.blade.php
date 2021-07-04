@if(Session::has('message') && Session::has('status'))
<div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show" role="alert">
    <span class="alert-icon">
        @if(Session::get('status') === 'success')
            <i class="ni ni-check-bold"></i>
        @elseif(Session::get('status') === 'danger')
            <i class="fas fa-times"></i>
        @endif
    </span>
    <span class="alert-text"><strong>{{ strtoupper(Session::get('status')) }}!</strong> {{ Session::get('message') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
