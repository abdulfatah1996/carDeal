 <!DOCTYPE html>

 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style" dir="ltr"
     data-theme="theme-default" data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template-free">

 <head>
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta charset="utf-8" />
     <meta name="viewport"
         content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

     <title> Car DEAL | @yield('title') </title>

     <meta name="description" content="" />

     <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link
         href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
         rel="stylesheet" />

     <!-- Icons. Uncomment required icon fonts -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

     <!-- Core CSS -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
     <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
         class="template-customizer-theme-css" />
     <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

     <!-- Vendors CSS -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
     <!--fontawesome-->
     <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
     <!--sweetalert2-->
     <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}" />
     <!--jquery-->
     <script src="{{ asset('assets/js/ajax_jquery.js') }}"></script>
     <!--Toastr-->
     <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
     <!-- Page CSS -->
     @yield('styles')
     <!-- Helpers -->
     <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
     <script src="{{ asset('assets/js/config.js') }}"></script>
 </head>

 <body>
     <!-- Content -->

     @yield('content')

     <!-- / Content -->
     </div>
     <!-- Core JS -->
     <!-- build:js assets/vendor/js/core.js -->
     <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
     <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
     <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

     <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->

     <!-- Main JS -->
     <script src="{{ asset('assets/js/main.js') }}"></script>

     <!--Toastr-->
     <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
     <!--sweetalert2-->
     <!--fontawesome-->
     <script src="{{ asset('assets/vendor/fontawesome/js/all.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
     <!-- Page JS -->
     @yield('scripts')
 </body>

 </html>
