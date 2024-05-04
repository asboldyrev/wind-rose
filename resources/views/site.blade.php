<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Роза ветров</title>

	@vite(['resources/scss/style.scss', 'resources/js/app.js'])

</head>

<body>
	<div class="container-fluid">
		<div id="app"></div>
	</div>
	<footer class="bg-body-tertiary">
		<div class="row gx-0 p-3">
			<div class="col">
				Исторические данные о погоде взяты с сервиса: <a target="_blank" href="https://open-meteo.com/">Open-Meteo</a>
			</div>
			<div class="col text-end">
				<a href="https://pay.cloudtips.ru/p/99b3202e" target="_blank">Поблагодарить автора</a>
			</div>
		</div>
	</footer>
</body>

</html>
