<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Le livre de jeu') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="{{asset('js/collapsible-behavior.js')}}"></script>
    <script src="https://tympanus.net/Development/AnimatedBooks/js/modernizr.custom.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=65zbam7degsr85vzz2nh3i6bou6evi4sopf9en2j8n8ndm0y"></script>
    <script>tinymce.init({
            selector: 'textarea',
            resize: 'both',
            plugins: [
                " advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools textcolor"
            ],
            toolbar: "undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify " +
            "| bullist numlist outdent indent | image imagetools",

            file_picker_types: 'image file',


            images_upload_handler: function (blobInfo, success, failure) {

                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/files-saveTinyMCE');
                //var token = document.getElementById("_token").value;
                xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });




                };
                input.click();
            }

        });

    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <!-- Styles -->
    <!--boostrap4-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!--site's defined css-->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lldj-styles.css') }}" rel="stylesheet">

    @yield('head')
</head>
<body>
<div id="app">

    @include('nav.nav')

    <main class="py-4">
        <div class="container-fluid">
        @yield('content')
        </div>
    </main>
</div>
@yield('js')
</body>
</html>
