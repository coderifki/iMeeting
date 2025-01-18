@extends('layout.app')

@section('content')
<!-- Main Content -->
<div class="flex-1 flex flex-col">
	<!-- Content -->
	<main class="p-6 flex">
		<!-- Back Button -->
		<a href="/" class="self-center">
			<button style="height: 40px; align-self: center"
				class="bg-[#18A2BA] text-white px-4 py-2 rounded-lg hover:bg-[#296377] fa-solid fa-chevron-left">
			</button>
		</a>
		<div class="p-4 grid items-center justify-between mt-4">
			<p class="text-gray-700 text-2xl">Add Meeting</p>

			<!-- Breadcrumb -->
			<nav class="text-sm font-medium text-gray-700">
				<ol class="list-reset flex">
					<li>
						<a href="/" class="text-gray-400 hover:text-blue-700">ruang meeting</a>
					</li>
					<li class="mx-2">/</li>
					<li>
						<a href="{{ route('add_room') }}" class="text-blue-500 hover:text-blue-700">Add
							Meeting</a>
					</li>
				</ol>
			</nav>
		</div>
	</main>
</div>
@endsection