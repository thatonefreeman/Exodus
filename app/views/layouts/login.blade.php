<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Kemptville Computers | Exodus Ticket System 1.0</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        {{ HTML::style('assets/css/morris/morris.css'); }}
        {{ HTML::style('assets/css/jvectormap/jquery-jvectormap-1.2.2.css'); }}
        {{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); }}
        {{ HTML::style('assets/css/AdminLTE.css'); }}
        {{ HTML::style('assets/css/bootstrap-datetimepicker.min.css'); }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        
        <div class="container-fluid bg-black">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                @yield('content')                    
            </div>
        </div>

        {{ HTML::script('assets/js/AdminLTE/app.js'); }}
        <script>
        $(function () {
            $('#expense_datetime').datetimepicker();
        });    
        </script>
    </body>
</html>
