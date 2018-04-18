<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!--<link rel="stylesheet" type="text/css" href="{{asset('/bootstrap/assets/css/bootstrap_united.css')}}" />-->
      <link rel="stylesheet" type="text/css" href="{{asset('/lib/bt3/css/bootstrap.css')}}" />


        <style>
            footer {
                margin-top:10px;
                text-align:center;
                color: white;
            }
            
            footer a{
                color: #FFFFFF;
                
            }
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #fff;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
                border: 1px solid #DBDBDB;
                box-shadow: 0px 0px 15px #CCC;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>

        <title> @yield('title')</title>
    </head>

    <body>

        <div class="container" id="page">


            @yield('content')



        </div><!-- page -->


    </body>
</html>
