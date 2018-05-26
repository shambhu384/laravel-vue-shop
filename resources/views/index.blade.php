<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        -<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="{{ asset("css/app.css") }}" rel="stylesheet" type="text/css">
    </head>
    </body>
		  <div id="app" class="container-flex">
        <app-component></app-component>
		  </div>
	</body>
	<script src="{{ asset("js/app.js") }}"></script>
</html>
