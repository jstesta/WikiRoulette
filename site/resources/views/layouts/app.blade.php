<!DOCTYPE html>
<html lang="{{ $lang }}">
	<head>
		<title>WikiRoulette - @yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">WikiRoulette</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="/refresh" data-toggle="tooltip" data-placement="bottom" title="refresh results">Spin! <span class="sr-only">(current)</span></a></li>
						<li><a href="/b" data-toggle="tooltip" data-placement="bottom" title="permalink most recent results">Permalink</a></li>
@yield('custom_nav')
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://github.com/jstesta/WikiRoulette" target="_new">GitHub Source</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			@yield('content')

			<hr noshade>
			<p>
				<strong>Disclaimer:</strong> These results are randomly generated from <a href="https://www.wikipedia.org">Wikipedia</a>.<br />
				This web site takes no responsiblity for the nature or content of pages displayed.<br />
				Use at your own risk!
			</p>
		</div>

		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});
		</script>
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha256-IF1P9CSIVOaY4nBb5jATvBGnxMn/4dB9JNTLqdxKN9w= sha512-UsfHxnPESse3RgYeaoQ7X2yXYSY5f6sB6UT48+F2GhNLqjbPhtwV2WCUQ3eQxeghkbl9PioaTOHNA+T0wNki2w==" crossorigin="anonymous">
	</body>
</html>
