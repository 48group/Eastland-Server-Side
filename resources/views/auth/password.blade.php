<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link type="text/css" rel="stylesheet" href="/css/materialize.css" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="/css/component.css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/js/jqueryui-editable.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/css/custom.css" />

    <!-- <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Poiret+One' rel='stylesheet' type='text/css'>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>

<body class="font-sourcesans">
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
                                <div class="panel-heading">
                                    {{--<h5 style="color:#fff;" class="center-align">Reset Password</h5>--}}
                                </div>
                                <div class="panel-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong class="white-text">Email invalid</strong><br>
                                        </div>
                                    @endif
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Send Password Reset Link
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</main>
<!-- end of main container -->
<!-- main footer -->
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container text-center">
            <a class="grey-text text-lighten-4" href="#!">&copy; 2015.All rights reserved.</a>
        </div>
    </div>
</footer>
<!-- end of main footer -->




<!--Import jQuery before materialize.js-->

<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/js/materialize.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</body>
</html>