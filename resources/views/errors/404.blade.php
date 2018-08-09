<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Error Page</title>

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    {{--<!-- Font Awesome -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/font-awesome/css/font-awesome.min.css">
    {{--<!-- Ionicons -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/Ionicons/css/ionicons.min.css">
    {{--<!-- Theme style -->--}}
    <link rel="stylesheet" href="/fw_fontend/dist/css/AdminLTE.min.css">
    {{--<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->--}}
    <link rel="stylesheet" href="/fw_fontend/dist/css/skins/_all-skins.min.css">
    {{--<!-- Fonts -->--}}
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body  class="hold-transition skin-blue sidebar-mini">

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <section class="content-header" style="margin-top: 5vh">
                <h1>
                    404 Error Page
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">404 error page not found</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="margin-top: 5vh">
                <div class="error-page">
                    <h2 class="headline text-yellow"> 404</h2>

                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                        <p>
                            We could not find the page you were looking for.
                            Meanwhile, you may <a href="{{ URL::previous() }}">return back</a> or try using the search
                            form.
                        </p>

                        <form class="search-form">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i
                                                class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.input-group -->
                        </form>
                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
            </section>

        </div>
    </div>
</div>

{{--<!-- jQuery 3 -->--}}
<script src="/fw_fontend/bower_components/jquery/dist/jquery.min.js"></script>
{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="/fw_fontend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
{{--<!-- FastClick -->--}}
<script src="/fw_fontend/bower_components/fastclick/fastclick.js"></script>
{{--<!-- AdminLTE App -->--}}
<script src="/fw_fontend/dist/js/adminlte.min.js"></script>
{{--<!-- AdminLTE for demo purposes -->--}}
<script src="/fw_fontend/dist/js/demo.js"></script>
</body>
</html>
