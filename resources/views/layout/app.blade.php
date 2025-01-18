<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>iMeeting</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 font-sans">
	<!-- Header -->
	<header class="bg-gradient-to-r from-[#18A2BA] to-[#296377] text-white p-4 flex items-center justify-between">
		<div class="flex items-center space-x-4">
			<img src="https://img.freepik.com/premium-vector/logo-pln-vector_588787-75.jpg" alt="PLN Logo" class="w-8">
			<h1 class="text-xl font-bold">iMeeting</h1>
		</div>
		<div class="flex items-center">
			<i class="fa-regular fa-bell mx-4"></i>
			<img class="w-8 h-8 rounded-full mr-2"
				src="https://img.freepik.com/premium-vector/logo-pln-vector_588787-75.jpg" alt="user photo">
			<span class="hidden md:inline">Jhon Doe</span>
			<!-- Dropdown -->
			<div class="relative">
				<button id="dropdownLargeButton" data-dropdown-toggle="dropdownNavbar"
					class="flex items-center justify-between px-4 py-2 text-sm font-medium text-white  border-gray-300 rounded-md shadow-sm focus:outline-none dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white">
					<i class="fa-solid fa-caret-down"></i>
				</button>
				<!-- Dropdown menu -->
				<div id="dropdownNavbar"
					class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLargeButton">
						<li>
							<a href="#"
								class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
						</li>
					</ul>
					<div class="py-1">
						<a href="#"
							class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
							out</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="flex h-screen">
		<!-- Sidebar -->
		<div class="w-16 bg-white text-black flex flex-col items-center py-4">

			<nav class="flex-1 space-y-4">
				<a href="{{ ('/dashboard') }}"
					class="block w-full text-center py-2 px-2 hover:bg-[#18A2BA] rounded {{ Request::routeIs('dashboard') ? 'bg-[#18A2BA]' : '' }}">
					<i class="fa-solid fa-house"></i>
				</a>
				<a href="{{	('/') }}"
					class="block w-full text-center py-2 px-2 hover:bg-[#18A2BA] rounded {{ Request::routeIs('add_room') || Request::routeIs('homepage') ? 'bg-[#18A2BA]' : '' }}">
					<i class="fa-solid fa-file"></i>
				</a>
			</nav>
		</div>
		<div class="flex-1 p-6">
			@yield('content')
		</div>
	</div>
</body>

</html>