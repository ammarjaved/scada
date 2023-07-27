<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.shared/title-meta', ['title' => $page_title])
 
</head>


    <body>
       

          @include('layout.shared/topbar')

        @yield('content')
        
    </body>

    @yield('script')
</html>
