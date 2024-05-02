<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Wind rose</title>

	@vite(['resources/scss/style.scss', 'resources/js/app.js'])

</head>

<body>
	<div class="container-fluid">
		<div id="app"></div>
	</div>
</body>

</html>
