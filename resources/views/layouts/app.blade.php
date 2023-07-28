
<html lang="en">
<head>
    @include('layouts.shared.meta-title')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
 @include('layouts.shared.nav-bar')
 @include('layouts.shared.side-bar')
 <div class="content-wrapper">

  <div id="overlay">
    <div class="loading-spinner"></div>
  </div>

 @yield('content')
 </div>
    </div>
 @include('layouts.shared.footer')
</body>
</html>
