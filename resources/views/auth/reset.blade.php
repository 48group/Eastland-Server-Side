<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/css/materialize.css" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="/css/component.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/style2.css" />
  <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>

-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/js/jqueryui-editable.min.js"></script>

    <link type="text/css" rel="stylesheet" href="/css/custom.css" />
    <script src="/js/modernizr.custom.js"></script>

    <!-- <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Poiret+One' rel='stylesheet' type='text/css'>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>

<body class="font-sourcesans">
<!-- main navbar -->
<header>
    <nav class="">

        <div class="nav-wrapper">
            <a href="#" class="brand-logo font-poiretone"></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <!-- <li><a href="">Home</a></li>
                <li><a href="">About</a></li> -->
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <!-- <li><a href="">Home</a></li>
                <li><a href="">About</a></li> -->
            </ul>
        </div>
    </nav>
</header>
<!-- end of main navbar -->
<!-- main container -->
<main>
    <div class="container">
        <div class="row">
            <div class="col s12 s4 offset-s4 l4 offset-l4 pd-10">
                <img src="/images/logo.png" class="responsive-img">
                <!--<a class="waves-effect waves-light btn-large btn-block modal-trigger" href="#modal1">Sign In</a>-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Password</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Confirm Password</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger white-text">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Reset Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <p class="grey-text text-lighten-4 mt-10">Problems Signing in? Please check <a href="#">here</a>.</p>-->




                <!-- modal -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Modal Header</h4>
                        <p>A bunch of text</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                    </div>
                </div>


                <!-- end modal -->

</main>
<!-- end of main container -->
<!-- main footer -->
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container text-center">

            <!-- <a class="grey-text text-lighten-4 right" href="#!">About</a> -->
            <a class="grey-text text-lighten-4" href="#!">&copy; 2015.All rights reserved.</a>
        </div>
    </div>
</footer>
<!-- end of main footer -->




<!--Import jQuery before materialize.js-->

<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/jquery.imagesloaded.min.js"></script>
<script src="/js/cbpBGSlideshow.js"></script>
<!-- <script src="js/cbpBGSlideshow.min.js"></script> -->
<script>
    $(function() {
        cbpBGSlideshow.init();
    });
</script>
<script type="text/javascript" src="/js/materialize.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</body>
</html>