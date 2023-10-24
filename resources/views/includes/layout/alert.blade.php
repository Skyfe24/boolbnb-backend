@if (session('alertMessage'))
    <div class="alert alert-{{ session('alertType') }} alert-dismissible fade show my-3" role="alert">
        @if (session('alertTitle'))
            <span>"<strong> {{ session('alertTitle') }} </strong>" </span>
        @endif
        <span> {{ session('alertMessage') }} </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
