<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="{{asset('/bootstrap/assets/css/bootstrap_united.css')}}" />

        <style>
            footer {
                margin-top:10px;
                text-align:center;
            }
        </style>

        <title> @yield('title')</title>
    </head>

    <body>

        <div class="container" id="page">


            @yield('content')



        </div><!-- page -->


        <footer>
            <div class="subnav navbar navbar-fixed-bottom">
                <div class="navbar-inner">
                    <div class="container">
                        Desarrollado por <a href="#" target="_new">MiguelAngel.MontesO@gmail.com</a>. Todos los derechos reservados.<br /><small>Powered by <a href="http://www.yiiframework.com" title="Yii Framework" target="_new">Yii Framework</a> and <a href="http://twitter.github.com/bootstrap/" title="Twitter Bootstrap" target="_new">Twitter Bootstrap</a></small>
                    </div>
                </div>
            </div>      
        </footer>
    </body>
</html>
