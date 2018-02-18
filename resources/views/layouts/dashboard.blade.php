<!DOCTYPE html>
<html>
<head>
 @include('includes.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
   @include('includes.header')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  @include('includes.sidemenu')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @stack('sectionheader')

    <!-- Main content -->
    <section class="content">

        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('includes.footer')
</div>
<!-- ./wrapper -->
@include('includes.script')
<!-- jQuery 3 -->
</body>
</html>
