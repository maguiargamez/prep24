<html lang="en">
	<!--begin::Head-->
	<head>
		<base href="../../../"/>
		<title>PREP 2024</title>
		<meta charset="utf-8" />		
		
		<meta property="og:locale" content="en_US" />
		<meta property="og:site_name" content="PREP 2024" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        
        <link href="{{ asset('metronic/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
	</head>
	<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">

		<script>
		var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
		</script>

		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>
			body { background-image: url({{ asset('metronic/media/auth/bg10.jpeg') }}); } [data-theme="dark"] 
			body { background-image: url({{ asset('metronic/media/auth/bg10-dark.jpeg') }}); }
			</style>

			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
                 @yield('content')
			</div>
		</div>

		<script>var hostUrl = "{{ asset('metronic/') }}";</script>

		<script src="{{ asset('metronic/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('metronic/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('metronic/js/custom/authentication/sign-in/general.js') }}"></script>                            
    </body>
</html>