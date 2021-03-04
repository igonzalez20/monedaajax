<!-- base  del frontend -->
<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Frontend - @yield('title')</title>
    </head>
    <body>
        <h1>Frontend @yield('titlePart')</h1>
        
        @section('subtitle')
        <h2>This is the subtitle h2</h2>
        @show
        
        @yield('content')
    </body>
</html>