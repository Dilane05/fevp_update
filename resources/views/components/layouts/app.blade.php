<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#10B981">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$header ?? 'fevp'}}</title>


    <meta name="msapplication-TileColor" content="#1F2937">

    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/fullcalendar/main.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/leaflet/dist/leaflet.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/medium-editor/css/medium-editor.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/trix/trix.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/medium-editor/css/themes/default.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/theme.css')}}" rel="stylesheet">

    @livewireStyles
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    @stack('scripts_head')
    @stack('css')
</head>

<body class="bg-pattern">

    {{$slot}}

    <script src=" {{ asset('vendor/@popperjs/core/dist/umd/popper.min.js')}}">
    </script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
    <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js')}}"></script>
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
    <script src="{{ asset('vendor/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{ asset('vendor/fullcalendar/main.min.js')}}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{ asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>
    <script src="{{ asset('vendor/leaflet/dist/leaflet.js')}}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{ asset('vendor/choices.js/public/assets/scripts/choices.min.js')}}"></script>
    <script src="{{ asset('vendor/medium-editor/js/medium-editor.js')}}"></script>
    <script src="{{ asset('vendor/trix/trix.umd.min.js')}}"></script>

    <script src="{{ asset('js/theme.js')}}"></script>

    @livewireScripts
    <script>
        document.addEventListener('livewire:init', () => {
            // Runs after Livewire is loaded but before it's initialized
            // on the page...
            var form = document.querySelector('.form-modal')
            if (form) {
                form.addEventListener('submit', function(e) {
                    var btn = document.querySelector('button[type="submit"].btn-loading')
                    btn.setAttribute('disabled', true)
                    btn.innerHtml =
                        `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>{{ __('Loading') }}...`
                })
            }

            // closing any modal dynamically
            window.Livewire.on('cancel', ({
                modalId
            }) => {

                const modal = document.getElementById(modalId);
                if (modal) {
                    modalEl = bootstrap.Modal.getInstance(modal)
                    modalEl.hide()
                }

            });


            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>

    @stack('scripts')
</body>

</html>
