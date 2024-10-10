<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard</title>
</head>
<body>
    <!-- Include the header -->
    @include('layout.header')
    <!-- Main content area where pages will inject content -->
    <div class="content">
        @include('layout.loader')
        @include('layout.sidebar')
        <main class="main-content">
            @include('layout.uppermenu')
            @yield('content')
        </main>
    </div>
    @include('layout.setting')
    <!-- Include the footer -->
    @include('layout.footer')
</body>
</html>
