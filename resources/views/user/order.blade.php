<x-app-layout>
<div class="relative flex size-full min-h-screen flex-col bg-[#fcf8f9] group/design-root overflow-x-hidden pt-24" style='font-family: Epilogue, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
          <div class="max-w-4xl mx-auto  rounded-xl shadow-lg p-4 mt-10 border">
            <div class="flex flex-col md:flex-row">
              <!-- Gambar Produk -->  
              <div class="md:w-3/4 mb-4 md:mb-0">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }} class="rounded-lg w-full h-auto object-cover">
              </div>
        
              <!-- Informasi Produk -->
              <div class="md:w-1/2 md:pl-4">
                <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $product->name }}</h2>
                <p  class="text-lg text-gray-600 mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        
                <div class="space-y-2 mb-4">
                  <button  onclick="openCalendar()" class="w-full bg-[#ee2b5c] hover:bg-red-700 text-white py-2 rounded-lg font-bold text-center block">Beli</button>
                  <button id="addToCartBtn" class="w-full border border-[#ee2b5c] text-[#ee2b5c] hover:bg-[#e66e8c] py-2 rounded flex items-center justify-center gap-2">Keranjang</button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
      
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Rating -->
                <div class="mt-4">
                  <div class="flex items-center text-sm text-gray-700 font-semibold mb-2">
                    <span class="text-2xl font-bold text-black">0.0 ⭐</span>
                  </div>
                  
                  <!-- Bar Rating -->
                  <div class="space-y-1">
                    <div class="flex items-center">
                      <span class="w-4 text-sm">5</span>
                      <div class="w-full h-2 bg-gray-200 rounded mx-2">
                        <div class="h-full bg-yellow-400 rounded" style="width: 0%"></div>
                      </div>
                      <span class="text-xs text-gray-500">0%</span>
                    </div>
                    <div class="flex items-center">
                      <span class="w-4 text-sm">4</span>
                      <div class="w-full h-2 bg-gray-200 rounded mx-2">
                        <div class="h-full bg-yellow-400 rounded" style="width: 0%"></div>
                      </div>
                      <span class="text-xs text-gray-500">0%</span>
                    </div>
                    <div class="flex items-center">
                      <span class="w-4 text-sm">3</span>
                      <div class="w-full h-2 bg-gray-200 rounded mx-2">
                        <div class="h-full bg-yellow-400 rounded" style="width: 0%"></div>
                      </div>
                      <span class="text-xs text-gray-500">0%</span>
                    </div>
                    <div class="flex items-center">
                      <span class="w-4 text-sm">2</span>
                      <div class="w-full h-2 bg-gray-200 rounded mx-2">
                        <div class="h-full bg-yellow-400 rounded" style="width: 0%"></div>
                      </div>
                      <span class="text-xs text-gray-500">0%</span>
                    </div>
                    <div class="flex items-center">
                      <span class="w-4 text-sm">1</span>
                      <div class="w-full h-2 bg-gray-200 rounded mx-2">
                        <div class="h-full bg-yellow-400 rounded" style="width: 0%"></div>
                      </div>
                      <span class="text-xs text-gray-500">0%</span>
                    </div>
                  </div>
        
                  <!-- Review Text -->
                  <p class="text-sm mt-3 text-gray-700 font-medium">All Reviews</p>
                </div>
              </div>
            </div>
        
            <!-- Komentar -->
            <div class="mt-6 bg-white rounded-lg p-4 shadow-inner">
              <h3 class="text-md font-semibold text-gray-800 mb-2">Tambahkan Komentar</h3>
        
              <!-- Rating Bintang -->
              <div class="flex mb-3" id="starRating">
                <!-- Bintang akan dibuat pakai JavaScript -->
                <input type="hidden" id="rating" value="0">
                <!-- Placeholder -->
              </div>
        
              <!-- Textarea -->
              <textarea class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]" rows="3" placeholder="Tulis komentarmu di sini..."></textarea>
              <button class="mt-3 bg-[#ee2b5c] hover:bg-red-700 text-white text-sm px-4 py-2 rounded">Kirim</button>
            </div>
          </div>
    </div>
</div>
<div id="calendarModal" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl p-6 w-full max-w-3xl relative transform transition-all scale-95 opacity-0">
        <div class="flex justify-between items-center mb-4">
            <button onclick="prevMonth()" class="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200">Prev</button>
            <h3 id="calendarMonth" class="text-xl font-bold text-gray-800">Bulan Tahun</h3>
            <div class="flex gap-2">
                <button onclick="nextMonth()" class="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200">Next</button>
                <button onclick="closeCalendar()" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-2 text-center mb-4">
            <div class="py-1 font-bold text-gray-400 text-xs">MINGGU</div>
            <div class="py-1 font-bold text-gray-400 text-xs">SENIN</div>
            <div class="py-1 font-bold text-gray-400 text-xs">SELASA</div>
            <div class="py-1 font-bold text-gray-400 text-xs">RABU</div>
            <div class="py-1 font-bold text-gray-400 text-xs">KAMIS</div>
            <div class="py-1 font-bold text-gray-400 text-xs">JUMAT</div>
            <div class="py-1 font-bold text-gray-400 text-xs">SABTU</div>
        </div>

        <div id="calendarDays" class="grid grid-cols-7 gap-2"></div>
    </div>
</div>

<script>  
   let currentDate = new Date();
const calendarModal = document.getElementById('calendarModal');
const calendarDays = document.getElementById('calendarDays');
const calendarMonthLabel = document.getElementById('calendarMonth');
const slots = @json($slots);
const minDate = new Date("{{ $minDate->format('Y-m-d') }}");
const maxDate = new Date("{{ $maxDate->format('Y-m-d') }}");

function openCalendar() {
    calendarModal.classList.remove('hidden');
    setTimeout(() => {
        calendarModal.firstElementChild.classList.remove('scale-95', 'opacity-0');
        calendarModal.firstElementChild.classList.add('scale-100', 'opacity-100');
    }, 10);
    renderCalendar(currentDate);
}

function closeCalendar() {
    calendarModal.firstElementChild.classList.remove('scale-100', 'opacity-100');
    calendarModal.firstElementChild.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { calendarModal.classList.add('hidden'); }, 300);
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
}

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    calendarMonthLabel.textContent = date.toLocaleString('default', { month: 'long', year: 'numeric' });

    let html = '';
    const firstDay = new Date(year, month, 1).getDay();
    for(let i=0; i<firstDay; i++) html += '<div></div>';

    for(let day=1; day<=daysInMonth; day++){
        const dateObj = new Date(year, month, day);
        const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`; 

        const slotInfo = slots[dateStr] ?? { remaining: 0, is_closed: false };
        const isOutOfRange = dateObj < minDate || dateObj > maxDate;
        const isClosedOrFull = slotInfo.is_closed || slotInfo.remaining <= 0;

        html += `
            <div onclick="${(isOutOfRange || isClosedOrFull) ? 'return;' : `selectDate('${dateStr}')`}" 
                class="cursor-pointer flex flex-col items-center justify-center rounded-lg p-2 transition
                ${isOutOfRange || isClosedOrFull ? 'bg-gray-300 text-gray-400' : 'bg-gray-50 hover:bg-white text-gray-700'}">
                <span class="text-lg font-bold">${day}</span>
                <span class="text-xs">
                    ${isOutOfRange ? 'Minimal 7 hari' : isClosedOrFull ? 'Penuh/ditutup' : slotInfo.remaining + ' slot'}
                </span>
            </div>
        `;
    }

    calendarDays.innerHTML = html;
}

function selectDate(dateStr){
    const slotInfo = slots[dateStr] ?? { remaining: 0, is_closed: false };
    if(slotInfo.is_closed || slotInfo.remaining <= 0){
        alert('Tanggal ini penuh atau ditutup.');
        return;
    }
    window.location.href = "{{ url('/pesanan') }}/" + {{ $product->id }} + "?pickup_date=" + dateStr;
}
</script>
</x-app-layout>