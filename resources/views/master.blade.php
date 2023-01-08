<body class="  ">
  <!-- loader Start -->
   <div id="loading">
       <div class="loader simple-loader">
           <div class="loader-body"></div>
       </div>    </div>
     <!-- loader END -->

      @include('layouts.header')
      @include('layouts.sidebar')
      @include('layouts.topbar')

      @yield('content')

      @include('layouts.footer')
      @include('layouts.sidebar_right')



  </body>
</html>

