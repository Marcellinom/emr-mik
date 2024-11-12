<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') &bullet; rme-mik</title>

    {{--    icon--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- vendor CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/assets/css/docs.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('prestyles')
    @yield('prescripts')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        #content {
            min-height: 66vh;
        }
        @media (min-width: 992px) {
            #content {
                min-height: 69vh;
            }
        }
        html {
            height: 100%;
        }
        body {
            min-height: 100%;
        }
    </style>

    @yield('styles')
</head>

<body style="min-height: 100%;">
@include('layouts.header-atas')
<div class="container-fluid">
    <div class="row flex-xl-nowrap" style=" background-color: #f6f4fa">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar" style="box-shadow:0 .6rem 1rem rgba(0,0,0,.15); background-color: white">
            @include('layouts.navbar-kiri')
        </div>
        <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5" role="main">
            <div class="bd-title">
                <span style="font-size: 2rem; font-weight: 500">@yield('content-header')</span>

                @hasSection('content-header-specific')
                    <span style="font-size: 1.3rem; color: grey; ">> @yield('content-header-specific')</span>
                @endif
            </div>
            @hasSection('content-body-upper')
                <div style="background-color: white; padding: 10px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 20px">
                    @yield('content-body-upper')
                </div>
            @endif
            <br>
            <div id="content-body" style="background-color: white; padding: 10px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 20px">
            @yield('content-body')
            </div>
        </main>
{{--        opsional--}}
        <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-sidebar">
            @yield('navbar-kanan')
        </div>
    </div>
</div>

@yield('scripts')


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    @if(isset($readonly) and $readonly === true)
        const contentBody = document.getElementById('content-body');
        if (contentBody) {
            // Select all clickable elements inside content-body
            const clickables = contentBody.querySelectorAll('a, button, input, [onclick]');

            // Make each element unclickable
            clickables.forEach(element => {
                // For <a> tags, prevent their default behavior
                if (element.tagName === 'A') {
                    element.addEventListener('click', event => event.preventDefault());
                }
                // For <button> and <input>, disable them
                else if (element.tagName === 'BUTTON' || element.tagName === 'INPUT') {
                    element.disabled = true;
                }
                // For other elements with an 'onclick' attribute, remove it
                else if (element.hasAttribute('onclick')) {
                    element.removeAttribute('onclick');
                }
            });
        }
    @endif
</script>
@yield('js')
</body>
</html>
