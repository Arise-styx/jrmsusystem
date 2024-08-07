<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    @if ($name != '')
        <title>{{ $name }} | MOELCI 1 - Audit</title>
    @else
        <title>MOELCI 1 - Audit</title>
    @endif
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/roboto-font.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-5/css/fontawesome-all.min.css') }}"> --}}
    {{-- Font Awesome --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    {{-- Bootstrap CDN --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/report_style.css') }}">
    @stack('styles')
</head>

<body>

    <section class="form-v5">
        <div class="page-content">
            <div class="form-v5-content">
                @yield('maincontent')
            </div>
        </div>
    </section>

    {{-- Bootstrap CDN --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
