<x-app-layout>
<div class="max-w-4xl mx-auto pt-24">
    <h1 class="text-3xl font-bold text-[#ee2b5c] mb-6">Daftar Pesanan</h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
        <table class="min-w-full divide-y divide-gray-200 border">
            <thead class="bg-[#f3e7ea] text-[#1b0d11]">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    @foreach($order->orderItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $order->pickup_date }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="@if($order->status==='pending') text-yellow-600
                                             @elseif($order->status==='completed') text-green-600
                                             @elseif($order->status==='cancelled') text-red-600
                                             @else text-blue-600 @endif font-bold">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($order->status === 'pending')
                                <form action="{{ route('user.list-pesanan.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">Batal</button>
                                </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
