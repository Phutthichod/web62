
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/soa/style.css')}}">

</head>
<body>
    <div id="navbar">
        @include('soa.template.navbar')
    </div>
<div id="container" style="width: 70%; margin:auto">

    <div id="content" style="text-align: center">
        @yield('content')
    </div>

</div>
</body>

</html>
