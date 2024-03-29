<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Quản trị' }}</title>
    <!-- css -->
    <base href="/">
    <link href="assets/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/admin/css/styles.css" rel="stylesheet">
    <!-- download pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
    <!--Icons-->
    <script src="assets/admin/js/lumino.glyphs.js"></script>
    <link rel="stylesheet" href="assets/admin/Awesome/css/all.css">
</head>

<body>
    <!-- header -->
    @include('admin.layouts.nav')
    <!-- header -->
    <!-- sidebar left-->
    @include('admin.layouts.sidebar')
    <!--/. end sidebar left-->

    <!--main-->
    @yield('content')
    <!--end main-->

    @section('script')

{{--  @endsection  --}}
	<!-- javascript -->
	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
     <script src="/assets/admin/js/chart.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
        @yield('scripts')


        <script>
            $(document).ready(function() {
                const pageId = $("#page-id").val();
                $(`.menu-${pageId}`).parents('li').addClass('active');
            })
        </script>
    @show
    @stack('adminJs')

</body>

</html>
