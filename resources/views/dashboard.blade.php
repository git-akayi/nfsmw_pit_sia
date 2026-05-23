<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-black text-2xl text-[#e32b2b] leading-tight uppercase tracking-[0.2em] italic">
                {{ __('Driver Command Center') }}
            </h2>
            <div class="flex items-center gap-2">
                <div class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                </div>
                <span class="text-[9px] font-black text-red-600 uppercase tracking-widest italic hidden sm:block">Live Link Active</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="flash-notification-box"></div>

            <div class="flex justify-end mb-6">
                <button onclick="toggleTunerPanel()"
                    class="bg-black hover:bg-[#1c1c1c] text-gray-400 hover:text-red-500 font-black text-[11px] uppercase tracking-wider py-2 px-4 border border-gray-800 transition-all flex items-center gap-2 italic select-none">
                    <span>// TOGGLE ECU TUNER</span>
                    <svg id="tuner-chevron" class="w-3 h-3 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div class="bg-[#151515]/80 border-l-4 border-red-600 p-6 shadow-2xl flex flex-col md:flex-row gap-6 items-center md:items-stretch">

                <div class="flex-shrink-0">
                    <div class="relative w-40 h-40 border-2 border-red-600 rounded-md overflow-hidden shadow-[0_0_15px_rgba(220,38,38,0.3)] bg-black">
                        <img class="w-full h-full object-cover"
                            src="{{ asset('images/avatars/' . (Auth::user()->avatar ?? 'nfsmw.jpg')) }}"
                            onerror="this.src=quot;{{ asset('images/avatars/nfsmw.jpg') }}quot;"
                            alt="{{ Auth::user()->name }}">
                        <div class="absolute inset-0 border border-white/10 pointer-events-none"></div>
                    </div>
                </div>

                <div class="flex-grow flex flex-col justify-between w-full">

                    <div class="border-b border-gray-900 pb-3 mb-4 flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 text-center sm:text-left">
                        <h2 class="text-3xl font-black text-white uppercase tracking-tight italic">
                            ALIAS: <span class="text-red-600">{{ Auth::user()->name }}</span>
                        </h2>
                        <div class="text-xl font-black text-red-600 uppercase tracking-tight italic">
                            RANK <span class="text-white font-mono">#{{ Auth::user()->blacklist_rank }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        <div class="bg-[#222222]/40 p-3 border border-gray-900">
                            <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest mb-1">Bounty</p>
                            <p class="text-xl font-black text-orange-500 font-mono tracking-tighter">${{ number_format(Auth::user()->bounty) }}</p>
                        </div>
                        <div class="bg-[#222222]/40 p-3 border border-gray-900">
                            <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest mb-1">Ride</p>
                            <p class="text-sm font-black text-white truncate mt-1">{{ Auth::user()->signature_car }}</p>
                        </div>
                        <div class="bg-[#222222]/40 p-3 border border-gray-900">
                            <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest mb-1">Area</p>
                            <p class="text-sm font-black text-red-600 truncate mt-1">{{ Auth::user()->territory }}</p>
                        </div>
                        <div class="bg-[#222222]/40 p-3 border border-gray-900">
                            <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest mb-1">Specialty</p>
                            <p class="text-sm font-black text-white truncate mt-1">{{ Auth::user()->race_specialty }}</p>
                        </div>
                        <div class="bg-[#222222]/40 p-3 border border-gray-900 col-span-2 sm:col-span-1">
                            <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest mb-1">Garage</p>
                            <p class="text-xl font-black text-white font-mono">{{ Auth::user()->cars_owned }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <div id="tuner-panel" class="max-h-0 overflow-hidden transition-all duration-500 mt-0 opacity-0">
                <div class="bg-[#181818] border border-gray-900 p-6 shadow-2xl mt-8">
                    <form method="POST" action="{{ route('dashboard.tune-stats') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                        @csrf @method('PATCH')

                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Rank</label>
                            <input type="number" name="blacklist_rank" value="{{ Auth::user()->blacklist_rank }}" class="w-full bg-black border-gray-800 text-white p-2 text-sm focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Bounty</label>
                            <input type="number" name="bounty" value="{{ Auth::user()->bounty }}" class="w-full bg-black border-gray-800 text-orange-500 p-2 text-sm focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Ride</label>
                            <input type="text" name="signature_car" value="{{ Auth::user()->signature_car }}" class="w-full bg-black border-gray-800 text-white p-2 text-sm focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Area</label>
                            <input type="text" name="territory" value="{{ Auth::user()->territory }}" class="w-full bg-black border-gray-800 text-red-500 p-2 text-sm focus:border-red-600 focus:ring-0">
                        </div>

                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Specialty</label>
                            <select name="race_specialty" class="w-full bg-black border-gray-800 text-white p-2 text-sm focus:border-red-600 focus:ring-0">
                                <option value="Sprint" {{ Auth::user()->race_specialty == 'Sprint' ? 'selected' : '' }}>Sprint</option>
                                <option value="Circuit" {{ Auth::user()->race_specialty == 'Circuit' ? 'selected' : '' }}>Circuit</option>
                                <option value="Drag" {{ Auth::user()->race_specialty == 'Drag' ? 'selected' : '' }}>Drag</option>
                                <option value="Drift" {{ Auth::user()->race_specialty == 'Drift' ? 'selected' : '' }}>Drift</option>
                                <option value="Speedtrap" {{ Auth::user()->race_specialty == 'Speedtrap' ? 'selected' : '' }}>Speedtrap</option>
                                <option value="Knockout" {{ Auth::user()->race_specialty == 'Knockout' ? 'selected' : '' }}>Knockout</option>
                                <option value="Tollbooth" {{ Auth::user()->race_specialty == 'Tollbooth' ? 'selected' : '' }}>Tollbooth</option>
                                @if(Auth::user()->blacklist_rank == 1)
                                <option value="Everything" {{ Auth::user()->race_specialty == 'Everything' ? 'selected' : '' }}>Everything</option>
                                @endif
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-black tracking-wider mb-1">Garage</label>
                            <input type="number" name="cars_owned" value="{{ Auth::user()->cars_owned }}" class="w-full bg-black border-gray-800 text-white p-2 text-sm focus:border-red-600 focus:ring-0">
                        </div>

                        <div class="md:col-span-6 flex justify-end mt-4">
                            <button type="submit" class="bg-red-700 text-white text-xs font-black uppercase px-6 py-3 italic hover:bg-red-600 transition tracking-wider">Commit Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleTunerPanel() {
            const panel = document.getElementById('tuner-panel');
            const chevron = document.getElementById('tuner-chevron');
            if (panel.style.maxHeight === '0px' || !panel.style.maxHeight || panel.style.maxHeight === '0') {
                panel.style.maxHeight = panel.scrollHeight + "px";
                panel.style.opacity = "1";
                panel.style.marginTop = "2rem";
                chevron.classList.add('rotate-180');
            } else {
                panel.style.maxHeight = "0";
                panel.style.opacity = "0";
                panel.style.marginTop = "0";
                chevron.classList.remove('rotate-180');
            }
        }
    </script>
</x-app-layout>