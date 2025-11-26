@extends('admin.layout')

@section('content')
    
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Notifikasi Pesanan</h2>
            <p class="text-sm text-gray-500">Persetujuan pesanan masuk yang perlu diproses.</p>
        </div>
        <button onclick="window.location.reload()" class="text-sm text-orange-600 font-bold hover:text-orange-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Refresh Data
        </button>
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 text-sm font-medium cursor-pointer">
                <option>Status (Pending)</option>
                <option>Ditolak</option>
                <option>Semua</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>

        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 text-sm font-medium cursor-pointer">
                <option>Tanggal (Hari Ini)</option>
                <option>Minggu Ini</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        @forelse($groupedOrders as $kategori => $orders)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
                <div class="bg-[#606C38] px-6 py-3 flex justify-between items-center">
                    <h3 class="text-white font-bold text-lg tracking-wide">{{ $kategori }}</h3>
                    <span class="bg-white/20 text-white text-xs px-2 py-1 rounded">{{ count($orders) }} Pesanan</span>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                            <th class="px-6 py-4 font-semibold">Faktur</th>
                            <th class="px-6 py-4 font-semibold">Waktu</th>
                            <th class="px-6 py-4 font-semibold">Pembayaran</th>
                            <th class="px-6 py-4 font-semibold text-center">Jml</th>
                            <th class="px-6 py-4 font-semibold">Nama</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">#APM-{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">Tunai</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">
                                {{ $order->orderItems->sum('quantity') }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $order->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openModal('{{ $order->user->name }}', '{{ $order->orderItems->sum('quantity') }}', '{{ $order->created_at->format('d M Y') }}')" 
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-4 rounded-lg shadow-sm transition text-xs uppercase tracking-wider">
                                    Terima?
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div class="p-12 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Semua Beres!</h3>
                <p class="text-gray-500 text-sm mt-1">Tidak ada pesanan baru yang perlu persetujuan saat ini.</p>
            </div>
        @endforelse
    </div>

    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl w-96 p-8 relative text-center transform transition-all scale-100">
            <div class="mx-auto mb-6 w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <p class="text-gray-800 font-medium text-lg mb-8 leading-relaxed">
                Apakah Anda ingin menerima pesanan dari <span id="modalNama" class="font-bold text-green-700">...</span> 
                sebanyak <span id="modalJumlah" class="font-bold">...</span> pcs
                pada tanggal <span id="modalTanggal" class="font-bold">...</span>?
            </p>
            <div class="flex justify-center gap-4">
                <button onclick="closeModal()" class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition">
                    Tidak
                </button>
                <button onclick="alert('Fitur terima akan aktif setelah integrasi User!')" class="w-1/2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl transition">
                    Ya, Terima
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal(nama, jumlah, tanggal) {
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalJumlah').innerText = jumlah;
            document.getElementById('modalTanggal').innerText = tanggal;
            document.getElementById('confirmModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>
@endsection