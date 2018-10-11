<!DOCTYPE HTML>
<html>

<head>

	<title>Sorteios</title>
</head>

<body class="is-preload">
	<div>
		<img src={{$CAPTCHA_URL}} />
	</div>
	<div>
		<form method='POST' action='{{url("/")}}'>
			{{ csrf_field() }}
			<input type='text' name='captcha' />
			<input type='hidden' name='key' value='{{$chave}}' />
			<button type='submit'>aa</button>
		</form>
	</div>
</body>

</html>