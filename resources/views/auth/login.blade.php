<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <meta name="_token" content="{!! csrf_token() !!}"/>
      <!--Import materialize.css-->
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
            <form method="POST" action="{{ url('auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <ul id="sign-in">
                  </li>
                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <strong class="white-text">Email or Password invalid</strong><br>
                      </div>
                  @endif
                  <li>
                <li>
                  <div class="input-field col s12">
                    <input id="first_name" type="text" class="first_name" name="email" style="color: #eee">
                    <label for="first_name">Username</label>
                  </div>
                </li>
                <li>
                  <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password" style="color: #eee">
                    <label for="first_name">Password</label>
                  </div>
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light btn-block btn-east" type="submit" name="action">Sign in</button>
                  </div>
                </li>
              </ul>
                <div class="input-field col s12">
                    <a href="{{url('/password/email')}}" class="white-text">Forgot Password</a>
                </div>
            </form>
              </div>
            </div>
          </div>


      <!-- end modal -->
      
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