@extends('admin.layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Rekap Penjualan</h2>
        <p class="text-sm text-gray-500">Arsip transaksi yang telah selesai diproses.</p>
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <option>Status Pembayaran (Paid)</option>
                <option>Unpaid</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>

        <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <option>Tanggal (1)</option>
                <option>Bulan Ini</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Faktur</th>
                        <th class="px-6 py-4 font-semibold">Waktu</th>
                        <th class="px-6 py-4 font-semibold">Pembayaran</th>
                        <th class="px-6 py-4 font-semibold text-center">Jumlah Item</th>
                        <th class="px-6 py-4 font-semibold">Action</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Nama</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($completedOrders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-900">APM-{{ 2000 + $order->id }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $order->created_at->translatedFormat('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">Tunai</td>
                        <td class="px-6 py-4 text-center font-medium text-gray-700">
                            {{ $order->orderItems->sum('quantity') }} pcs
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-400">Done</td>
                        <td class="px-6 py-4">
                            <span class="text-green-600 font-bold">Executed</span>
                        </td>
                        <td class="px-6 py-4 text-right font-medium text-gray-800">
                            {{ $order->user->name }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            Belum ada transaksi yang selesai (Completed).
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection