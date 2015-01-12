<!DOCTYPE html>
<html>
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
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{ URL::to('/'); }}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Kemptville Computers
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ Auth::user()->username }} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="#">My Tickets</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="{{ URL::to('reminders/home'); }}">My Reminders</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ URL::to('users/logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{ URL::to('/'); }}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Clients</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Add New Client</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Modify Clients</a></li>
                            </ul>
                        </li>
                        -->
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Tickets</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> Unread Tickets</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Archived Tickets</a></li>
                                <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Open Tickets</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> New Ticket</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Modify Ticket Classes</a></li>
                            </ul>
                        </li>
                        -->
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> Add User</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Modify User</a></li>
                            </ul>
                        </li>
                        -->
                        <li class="treeview {{{ Request::segment(1) == 'mileagetracker' ? 'active' : ''}}}">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Mileage Tracker</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ URL::to('/mileagetracker/'); }}"><i class="fa fa-angle-double-right"></i>Home</a></li>
                                <li><a href="{{ URL::to('/mileagetracker/newentry'); }}"><i class="fa fa-angle-double-right"></i> New Entry</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Export Logs</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Reports</a></li>
                                <li><a href="{{ URL::to('/mileagetracker/vehicles'); }}"><i class="fa fa-angle-double-right"></i> Vehicles</a></li>
                            </ul>
                        </li>  
                        
                        <li class="treeview {{{ Request::segment(1) == 'expensestracker' ? 'active' : ''}}}">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Expenses Tracker</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ URL::to('/expensestracker/'); }}"><i class="fa fa-angle-double-right"></i> Home</a></li>
                                <li><a href="{{ URL::to('/expensestracker/newentry'); }}"><i class="fa fa-angle-double-right"></i> New Entry</a></li>
                                <li><a href="{{ URL::to('/expensestracker/categories'); }}"><i class="fa fa-angle-double-right"></i> Expense Categories</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Reports</a></li>
                            </ul>
                        </li>           
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Ticket Settings</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Email Templates</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Database Backup</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Ticket Signature</a></li>
                        <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> System Settings</a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!-- Begin Blade Insertions -->
                @yield('content')
                <!-- End Blade Insertions -->
            </aside>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        {{ HTML::script('assets/js/moment.min.js'); }}
        {{ HTML::script('assets/js/bootstrap-datetimepicker.min.js'); }}
        {{ HTML::script('assets/js/plugins/morris/morris.min.js'); }}
        {{ HTML::script('assets/js/plugins/sparkline/jquery.sparkline.min.js'); }}
        {{ HTML::script('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); }}
        {{ HTML::script('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); }}
        {{ HTML::script('assets/js/plugins/jqueryKnob/jquery.knob.js'); }}
        {{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); }}
        {{ HTML::script('assets/js/plugins/iCheck/icheck.min.js'); }}
        {{ HTML::script('assets/js/AdminLTE/app.js'); }}
        <script>
        $(function () {
            $('#expense_datetime').datetimepicker();
        });    
        </script>
    </body>
</html>
