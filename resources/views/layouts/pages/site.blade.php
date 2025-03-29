@extends('layouts.main')

@section('content')
    @include('layouts.navbars.navbar_site')
    @if(session('msg'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Mensagem:</strong>
                    <small>{{ session('time') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-bg-dark">
                    {{ session('msg') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    @yield('content-page')
    @include('layouts.footers.footer_site')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('.toast').toast('show');
}); 
</script>
@endpush