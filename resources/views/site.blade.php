<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-language" content="ru" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.svg') }}" />

	<title>Роза ветров онлайн калькулятор</title>
	<meta name="keywords" content="роза ветров, генератор розы ветров, роза ветров онлайн" />
	<meta name="description" content="генератор розы ветров позволяет посмотреть розу ветров в любой точке мира за последние несколько лет" />

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
				<a href="https://pay.cloudtips.ru/p/99b3202e" target="_blank" onclick="document?.ym ? document?.ym(97196096, 'reachGoal', 'donate') : ()=>{}">Поблагодарить автора</a>
			</div>
		</div>
	</footer>
	@if (app()->environment('production'))
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
			(function(m, e, t, r, i, k, a) {
				m[i] = m[i] || function() {
					(m[i].a = m[i].a || []).push(arguments)
				};
				m[i].l = 1 * new Date();
				for (var j = 0; j < document.scripts.length; j++) {
					if (document.scripts[j].src === r) {
						return;
					}
				}
				k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
			})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			document.ym = ym
		</script>
		<noscript>
			<div><img src="https://mc.yandex.ru/watch/97196096" style="position:absolute; left:-9999px;" alt="" /></div>
		</noscript>
		<!-- /Yandex.Metrika counter -->
	@endif
</body>

</html>
