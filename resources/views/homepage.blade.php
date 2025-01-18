@extends('layout.app')

@section('content')
<!-- Main Content -->
<div class="flex-1 flex flex-col">
	<!-- Content -->
	<main class="p-6 flex-1">
		<!-- Main Content Section -->
		<div class="p-4 flex items-center justify-between mt-4">
			<div>
				<p class="text-gray-700 text-2xl">Ruang Meeting</p>

				<!-- Breadcrumb -->
				<nav class="text-sm font-medium text-gray-700 mt-2">
					<ol class="list-reset flex">
						<li>
							<a href="/" class="text-blue-500 hover:text-blue-700">ruang meeting</a>
						</li>
					</ol>
				</nav>
			</div>
			<a href="{{ '/create_roomeeting' }}">
				<button class="bg-[#18A2BA] text-white px-4 py-2 rounded-lg hover:bg-[#296377]">
					+ Pesan Ruangan
				</button>
			</a>
		</div>
	</main>
</div>
@endsection