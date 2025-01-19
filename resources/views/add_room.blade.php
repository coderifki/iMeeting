@extends('layout.app')

@section('content')
<!-- Main Content -->
<div class="flex-1 flex flex-col">
	<!-- Content -->
	<main class="p-6 flex flex-col">
		<!-- Back Button -->
		<div class="flex mb-4">
			<a href="/" class="self-center">
				<button style="height: 40px; align-self: center"
					class="bg-[#18A2BA] text-white px-4 py-2 rounded-lg hover:bg-[#296377] fa-solid fa-chevron-left">
				</button>
			</a>

			<!-- Page Title and Breadcrumb -->
			<div class="p-4 grid items-center justify-between mt-4">

				<p class="text-gray-700 text-2xl">Add Meeting</p>

				<nav class="text-sm font-medium text-gray-700">
					<ol class="list-reset flex">
						<li>
							<a href="/" class="text-gray-400 hover:text-blue-700">Ruang Meeting</a>
						</li>
						<li class="mx-2">/</li>
						<li>
							<a href="{{ route('add_room') }}" class="text-blue-500 hover:text-blue-700">Add Meeting</a>
						</li>
					</ol>
				</nav>
			</div>
		</div>

		<!-- Form -->
		<div class="bg-white p-6 rounded-lg shadow-lg">
			<form action="{{ route('save_meeting') }}" method="POST">

				@csrf

				<!-- Informasi Ruang Meeting -->
				<div>
					<h2 class="text-lg font-semibold text-gray-800">Informasi Ruang Meeting</h2>
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div>
							<label for="unit" class="text-gray-600">Unit</label>
							<label for="unit" class="text-red-500">*</label>
							<select id="unit" name="unit" class="w-full border-gray-300 rounded-lg" required>
								<option value="" selected>Pilih Unit</option>
								@foreach ($units as $unit)
								<option value="{{ $unit->id }}">{{ $unit->name }}</option>
								@endforeach
							</select>
						</div>
						<div>
							<label for="room" class="text-gray-600">Ruang Meeting</label>
							<label for="unit" class="text-red-500">*</label>
							<select id="room" name="room" class="w-full border-gray-300 rounded-lg" required>
								<option value="" selected>Pilih Ruang Meeting</option>
								@foreach ($rooms as $room)
								<option value="{{ $room->id }}">{{ $room->name }}</option>
								@endforeach
							</select>
						</div>
						<div>
							<label for="capacity" class="text-gray-600">Kapasitas</label>
							<input id="capacity" name="capacity" type="text"
								class="w-full bg-gray-300 border-gray-300 rounded-lg" value="0" readonly>
						</div>
					</div>
				</div>

				<!-- Informasi Rapat -->
				<div class="mt-8">
					<h2 class="text-lg font-semibold text-gray-800">Informasi Rapat</h2>
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div>
							<label for="date" class="text-gray-600">Tanggal Rapat</label>
							<label for="unit" class="text-red-500">*</label>
							<input id="date" name="date" type="date" class="w-full border-gray-300 rounded-lg" required>
						</div>
						<div>
							<label for="start_time" class="text-gray-600">Waktu Mulai</label>
							<label for="unit" class="text-red-500">*</label>
							<select id="start_time" name="start_time" class="w-full border-gray-300 rounded-lg"
								required>
								<option value="" selected>Pilih Waktu Mulai</option>
								@foreach (range(0, 23) as $hour)
								@foreach ([0, 30] as $minute)
								<option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
									{{ sprintf('%02d:%02d', $hour, $minute) }}
								</option>
								@endforeach
								@endforeach
							</select>
						</div>
						<div>
							<label for="end_time" class="text-gray-600">Waktu Selesai</label>
							<label for="unit" class="text-red-500">*</label>
							<select id="end_time" name="end_time" class="w-full border-gray-300 rounded-lg" required>
								<option value="" selected>Pilih Waktu Selesai</option>
								@foreach (range(0, 23) as $hour)
								@foreach ([0, 30] as $minute)
								<option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
									{{ sprintf('%02d:%02d', $hour, $minute) }}
								</option>
								@endforeach
								@endforeach
							</select>
						</div>
						<div>
							<label for="participants" class="text-gray-600">Jumlah Peserta</label>
							<label for="unit" class="text-red-500">*</label>
							<input id="participants" name="participants" type="number"
								class="w-full border-gray-300 rounded-lg" required min="1"
								max="{{ $room->capacity ?? 0 }}" required>

						</div>
					</div>

					<!-- Jenis Konsumsi -->
					<div class="mt-4">
						<label class="text-gray-600">Jenis Konsumsi</label>
						<div class="flex gap-4 mt-2">
							<label class="flex items-center">
								<input type="checkbox" id="snack_siang" name="consumption[]" value="Snack Siang"
									class="text-blue-500 border-gray-300 rounded" disabled>
								<span class="ml-2">Snack Siang</span>
							</label>
							<label class="flex items-center">
								<input type="checkbox" id="makan_siang" name="consumption[]" value="Makan Siang"
									class="text-blue-500 border-gray-300 rounded" disabled>
								<span class="ml-2">Makan Siang</span>
							</label>
							<label class="flex items-center">
								<input type="checkbox" id="snack_sore" name="consumption[]" value="Snack Sore"
									class="text-blue-500 border-gray-300 rounded" disabled>
								<span class="ml-2">Snack Sore</span>
							</label>
						</div>
					</div>

					<!-- Nominal Konsumsi -->
					<div class="grid grid-cols-2  mt-4">
						<div>
							<label for="cost" class="text-gray-600">Nominal Konsumsi</label>
							<input id="cost" name="cost" type="text"
								class="w-full bg-gray-300 border-gray-300 rounded-lg" value="Rp. 0" readonly>
						</div>
					</div>
				</div>

				<!-- Buttons -->
				<div class="mt-6 flex justify-end gap-4">
					<a href="/">
						<button type="button" class=" text-red-400 px-4 py-2 rounded-lg ">
							Batal
						</button>
					</a>
					<button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-400">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</main>
</div>
<script>
	document.getElementById('room').addEventListener('change', function () {
    const roomId = this.value; // Ambil ID room yang dipilih

    if (roomId) {
        // Panggil API untuk mendapatkan capacity
        fetch(`/api/rooms/${roomId}`)
            .then(response => response.json())
            .then(data => {
                if (data.capacity) {
                    document.getElementById('capacity').value = data.capacity;
                    document.getElementById('participants').setAttribute('max', data.capacity);
                } else {
                    document.getElementById('capacity').value = 0;
                    document.getElementById('participants').removeAttribute('max');
                    Swal.fire('Error', data.error || 'Something went wrong', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Gagal mengambil data kapasitas ruang meeting.', 'error');
            });
		} else {
			document.getElementById('capacity').value = 0; // Reset jika tidak ada room dipilih
		}
	});

	document.querySelector('form').addEventListener('submit', function (event) {
		const startTime = document.getElementById('start_time').value;
		const endTime = document.getElementById('end_time').value;

		if (startTime >= endTime) {
			event.preventDefault();
			// Swal.fire({
			// 	icon: 'error',
			// 	title: 'Waktu Tidak Valid',
			// 	text: 'Waktu selesai harus lebih besar dari waktu mulai.',
			// });
			alert('Waktu selesai harus lebih besar dari waktu mulai.');
		} 
	});

	document.addEventListener('DOMContentLoaded', function () {
		const startTimeInput = document.getElementById('start_time');
		const endTimeInput = document.getElementById('end_time');
		const participantsInput = document.getElementById('participants');
		const costInput = document.getElementById('cost');

		function calculateCost() {
			const snackSiang = document.getElementById('snack_siang').checked;
			const makanSiang = document.getElementById('makan_siang').checked;
			const snackSore = document.getElementById('snack_sore').checked;

			const participants = parseInt(participantsInput.value) || 0;

			// Harga satuan konsumsi
			const snackCost = 20000; // Harga Snack
			const lunchCost = 30000; // Harga Makan Siang

			let totalCost = 0;

			if (snackSiang) totalCost += participants * snackCost;
			if (makanSiang) totalCost += participants * lunchCost;
			if (snackSore) totalCost += participants * snackCost;

			// Format menjadi mata uang
			costInput.value = `Rp. ${totalCost.toLocaleString('id-ID')}`;
		}

		function updateConsumption() {
			const snackSiang = document.getElementById('snack_siang');
			const makanSiang = document.getElementById('makan_siang');
			const snackSore = document.getElementById('snack_sore');

			// Reset konsumsi
			snackSiang.checked = false;
			makanSiang.checked = false;
			snackSore.checked = false;

			const startTime = startTimeInput.value;
			const endTime = endTimeInput.value;

			if (startTime && endTime) {
				const start = new Date(`1970-01-01T${startTime}:00Z`).getTime();
				const end = new Date(`1970-01-01T${endTime}:00Z`).getTime();

				// Rule: Snack Siang jika mulai sebelum jam 11:00
				if (start < new Date('1970-01-01T11:00:00Z').getTime()) {
					snackSiang.checked = true;
				}

				// Rule: Makan Siang jika antara 11:00 dan 14:00
				if (
					(start <= new Date('1970-01-01T14:00:00Z').getTime() &&
						end >= new Date('1970-01-01T11:00:00Z').getTime())
				) {
					makanSiang.checked = true;
				}

				// Rule: Snack Sore jika selesai setelah jam 14:00
				if (end > new Date('1970-01-01T14:00:00Z').getTime()) {
					snackSore.checked = true;
				}
			}

			// Hitung biaya berdasarkan konsumsi
			calculateCost();
		}

		// Event listener untuk perubahan input
		startTimeInput.addEventListener('change', updateConsumption);
		endTimeInput.addEventListener('change', updateConsumption);
		participantsInput.addEventListener('input', calculateCost);
	});


</script>
@endsection