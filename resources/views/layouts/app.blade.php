<!doctype html>
<html lang="{{ str_replace('_', '-', $locale) }}" dir="{{ $locale === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Relax') }}</title>
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" /> --}}
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">
    @if ($locale === 'en')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/vendors.css') }}" rel="stylesheet" />
    @else
    <link href="{{ asset('css/app.rtl.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/vendors.rtl.css') }}" rel="stylesheet" />
    @endif
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" /> --}}
    @yield('style-nav')
    <script>
        @php
            $segments = request()->segments();
        @endphp
        window.page = { identifier: '{{ isset($segments[1]) ? $segments[1] : "base" }}' }
    </script>
</head>

<body>
    <div id="app">
        @auth
            @include('includes.sidebar')
            @include('includes.navbar')
            <main class="wrapper-container">
                @yield('content')
            </main>
        @else
            @yield('content')
        @endauth
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm:ss',
        interval: 15,
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
</script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/decoupled-document/ckeditor.js"></script> --}}
{{-- <script>
    window.onload = function() {
        let theTextarea = $(".target-styling").text()
        
        let editor = $("#editor")

        DecoupledEditor
            .create(document.querySelector('#editor'), {
                initialData:theTextarea,
                language: {
                    // The UI will be in English.
                    ui: 'ar',
                    // But the content will be edited in Arabic.
                    content: 'ar',
                    dir: 'ar'
			    }
            })
            .then(editor => {

                document.querySelector('#tools').
                appendChild(editor.ui.view.toolbar.element);
            })
            .catch(err => {});

            
        let myTextarea = $(".target-styling")

        editor.html(myTextarea.text())
    
        editor.css({
            border: '1px solid gray',
            height: '300px',
            background: 'white',
            padding: '0 40px',
            fontSize: '18px'
        })

        $("#editor,.card-body, #tools ,.save-goals, body ,html").on("click", function() {
            editor.html(myTextarea.text())
            editor.css({
                border: '1px solid gray',
                height: '300px',
                background: 'white',
                padding: '0 40px',
                fontSize: '18px'
            })
        })

        $(document).on("click", "#tools" , function() {
            let tagetStyling = editor.html()
            myTextarea.text(tagetStyling)
        })


        $(document).on("click", "#tools" , function() {
            let tagetStyling = editor.html()
            myTextarea.text(tagetStyling)
        })
        
        $(document).on("click",  ".ck" , function() {
            let tagetStyling = editor.html()
            myTextarea.text(tagetStyling)
        })

        editor.on("keyup", function() {
            let tagetStyling = $(this).html()
            myTextarea.text(tagetStyling)
        })
    }
</script> --}}

<script>
    //============================ Start preview image with custom input file =========================
    let preview;
    let previewScholar;
    $("input[type=file]").on("click", function() {
        preview = $(this).siblings("img")
        previewScholar = $(this).parent().siblings("img")
    })

    function showPreview(event) {
        if (event.target.files.length > 0) {
            let src = URL.createObjectURL(event.target.files[0]);
            preview.attr("src", src)
            previewScholar.attr("src", src)
        }
    }

    $(document).ready(function() {
        $(".m-select").chosen({
            // rtl: true,
            no_results_text: "Oops, nothing found!"
        })
    })

    // A fix for dropdowns that lives inside table responsive
    $('body').on('show.bs.dropdown', '.table-responsive', function () {
        $(this).css("overflow", "visible");
    })
    .on('hide.bs.dropdown', '.table-responsive', function () {
        $(this).css("overflow", "auto");
    });
</script>

</html>
