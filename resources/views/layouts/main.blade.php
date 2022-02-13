<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title> {{ count($app_name) > 0 ? $app_name[0] : '' }} Auto Tech </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="layout" content="main"/>

    <script src="{{ asset('js/jquery/jquery.min.js') }}" type="text/javascript" ></script>
    <link href="{{ asset('css/customize-template.css') }}" type="text/css" media="screen, projection" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/paginate.css') }}" rel="stylesheet"> -->
    @yield('style')
    <style>
        #body-content { padding-top: 40px;}

        i {
            font-weight: bold;
        }

        

        @font-face {
          font-family: 'FontAwesome';
          font-weight: normal;
          font-style: normal;
          src: url({{ asset('font/fontawesome-webfont.eot') }} );
          src: url({{ asset('font/fontawesome-webfont.eot?#iefix') }} ) format('embedded-opentype'), 
               url({{ asset('font/fontawesome-webfont.woff') }} ) format('woff'), 
               url({{ asset('font/fontawesome-webfont.ttf') }} ) format('truetype'), 
               url({{ asset('font/fontawesome-webfont.svg#FontAwesome') }} ) format('svg');
        }

       
    </style>
</head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="brand">
                        <i class="icon-leaf"> {{ count($app_name) > 0 ? $app_name[0] : '' }} Auto Tech </i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
                        <ul class="nav pull-right">
                            <li>
                                <a href="{{ route('sales.index') }}" > <i class="icon-shopping-cart icon-large"></i> &nbsp; Invoice <span class="badge"> {{ Cart::content()->count() }} </span>
                                </a>
                                
                            </li>
                            <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                     {{ Auth()->user()->first_name }}   
                                        <b class="caret hidden-phone"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                             <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#myModal">
                                               <i class="icon-user"></i></span> Edit Login 
                                            </a>
                                        </li>
                                        <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        </li>
                                    </ul>
                                </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="body-container">
            <div id="body-content">
                
                    <div class="body-nav body-nav-vertical body-nav-fixed">
                        <div class="container">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <i class="icon-dashboard icon-large"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}">
                                        <i class="icon-calendar icon-large"></i> Products
                                    </a>
                                </li>
                                @if( Auth()->user()->hasRole('admin') || Auth()->user()->hasRole('manager') )
                                <li>
                                    <a href="{{ route('product_name.index') }}">
                                        <i class="icon-cogs icon-large"></i> Options
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.index') }}">
                                        <i class="icon-user icon-large"></i> Users
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('sales.index') }}">
                                        <i class="icon-shopping-cart icon-large"></i> New Sales
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('transfer.index') }}">
                                        <i class="icon-road icon-large"></i> Transfer
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('summary.index') }}">
                                        <!-- <i class="icon-bar-chart icon-large"></i> -->
                                        <i class="icon-signal icon-large"></i> Invoice Summary
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                
                
        <!-- <section class="nav nav-page">
        <div class="container">
            <div class="row">
                <div class="span7">
                    <header class="page-header">
                        <h3>Dashboard Demo<br/>
                            <small>Additional Bootstrap Components</small>
                        </h3>
                    </header>
                </div>
                <div class="page-nav-options">
                    <div class="span9">
                        <ul class="nav nav-pills">
                            <li>
                                <a href="#"><i class="icon-home icon-large"></i></a>
                            </li>
                        </ul>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><i class="icon-home"></i>Home</a>
                            </li>
                            <li><a href="#">Maps</a></li>
                            <li><a href="#">Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="page container"> <!-- main -->
       
       @yield('content')
        
    </section> <!-- main content -->
       @include('users.profile_modal')

    

            </div>
        </div> <!-- container end -->

        
        <script src="{{ asset('js/bootstrap/bootstrap-transition.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-alert.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-modal.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-dropdown.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-scrollspy.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-tooltip.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-popover.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-button.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-collapse.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/bootstrap/bootstrap-affix.js') }}" type="text/javascript" ></script>  

       @yield('script')

    </body>
</html>