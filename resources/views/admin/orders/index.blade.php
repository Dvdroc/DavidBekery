@extends('admin.layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Status Pesanan</h2>
        <p class="text-sm text-gray-500">Pantau dan kelola status pesanan yang sedang berjalan.</p>
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <option>Status (Semua)</option>
                <option>Selesai</option>
                <option>Diproses</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>

        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <option>Tanggal (Hari Ini)</option>
                <option>Minggu Ini</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-8">
        @forelse($groupedOrders as $productName => $items)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                <div class="bg-[#606C38] px-6 py-3">
                    <h3 class="text-white font-bold text-lg tracking-wide">{{ $productName }}</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Faktur</th>
                                <th class="px-6 py-3 font-semibold">Waktu</th>
                                <th class="px-6 py-3 font-semibold">Pembayaran</th>
                                <th class="px-6 py-3 font-semibold text-center">Jml Pesanan</th>
                                <th class="px-6 py-3 font-semibold">Nama</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold text-right">Update</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">#APM-{{ $item->order->id }}</td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $item->order->created_at->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ ucfirst($item->order->delivery_type) }} </td>
                                <td class="px-6 py-4 text-center font-bold text-gray-800">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-gray-800">{{ $item->order->user->name }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'text-yellow-600 bg-yellow-50',
                                            'processing' => 'text-blue-600 bg-blue-50',
                                            'ready' => 'text-purple-600 bg-purple-50',
                                            'completed' => 'text-green-600 bg-green-50',
                                            'cancelled' => 'text-red-600 bg-red-50',
                                        ];
                                        $color = $statusColors[$item->order->status] ?? 'text-gray-600 bg-gray-50';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $color }}">
                                        {{ ucfirst($item->order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.orders.update', $item->order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-xs border-gray-300 rounded shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 cursor-pointer">
                                            <option value="pending" {{ $item->order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $item->order->status == 'processing' ? 'selected' : '' }}>Proses</option>
                                            <option value="ready" {{ $item->order->status == 'ready' ? 'selected' : '' }}>Siap</option>
                                            <option value="completed" {{ $item->order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $item->order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <p class="text-gray-500 font-medium">Belum ada pesanan masuk.</p>
            </div>
        @endforelse
    </div>
@endsection