<x-guest-layout>
    <div class="max-w-2xl mx-auto bg-[#141414] border border-red-900/40 p-8 shadow-2xl relative">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/nfs.png') }}" 
                     onerror="this.src='https://i.imgur.com/vHCHYmR.png'" 
                     class="h-16 object-contain filter drop-shadow-[0_0_10px_rgba(239,68,68,0.2)]" 
                     alt="Need For Speed Most Wanted">
            </div>
            <h2 class="text-xl font-black text-red-600 uppercase tracking-[0.25em] italic drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] animate-pulse">
                AUTHORIZED PERSONNEL ONLY
            </h2>
            <div class="h-[2px] bg-gradient-to-r from-transparent via-red-800 to-transparent w-3/4 mx-auto mt-3"></div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" value="{{ __('Driver Name') }}" class="text-gray-400 font-bold uppercase text-xs tracking-wider" />
                <x-text-input id="name" class="block mt-1 w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-red-600 uppercase font-black italic" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="{{ __('Officer ID (Email)') }}" class="text-gray-400 font-bold uppercase text-xs tracking-wider" />
                <x-text-input id="email" class="block mt-1 w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-red-600" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Security Passkey') }}" class="text-gray-400 font-bold uppercase text-xs tracking-wider" />
                <x-text-input id="password" class="block mt-1 w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-red-600" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="{{ __('Confirm Passkey') }}" class="text-gray-400 font-bold uppercase text-xs tracking-wider" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-red-600" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label value="SELECT YOUR OFFICER AVATAR" class="text-red-600 font-black text-xs tracking-[0.15em] mb-3 italic" />
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-black p-4 border border-gray-900 shadow-[inset_0_0_15px_rgba(0,0,0,0.8)] max-h-[340px] overflow-y-auto custom-scrollbar">
                    
                    @php
                        $drivers = [
                            'razor.png'   => 'Razor',
                            'bull.png'    => 'Bull',
                            'ronnie.png'  => 'Ronnie',
                            'baron.png'   => 'Baron',
                            'webster.png' => 'Webster',
                            'ming.png'    => 'Ming',
                            'kaze.png'    => 'Kaze',
                            'jewels.png'  => 'Jewels',
                            'earl.png'    => 'Earl',
                            'vic.png'     => 'Vic',
                            'jv.png'      => 'JV',
                            'izzy.png'    => 'Izzy',
                            'biglou.png'  => 'Big Lou',
                            'taz.png'     => 'Taz',
                            'sonny.png'   => 'Sonny'
                        ];
                    @endphp

                    @foreach($drivers as $filename => $displayname)
                    <label class="group cursor-pointer">
                        <input type="radio" name="avatar" value="{{ $filename }}" class="hidden peer">
                        <div class="relative overflow-hidden border border-gray-800 grayscale group-hover:grayscale-0 peer-checked:grayscale-0 peer-checked:border-red-600 transition-all duration-300">
                            <img src="{{ asset('images/avatars/' . $filename) }}" class="w-full h-24 object-cover" alt="{{ $displayname }}">
                            <div class="absolute bottom-0 w-full bg-black/80 text-[9px] text-center text-gray-400 font-black tracking-tighter py-0.5 group-hover:text-red-500 peer-checked:text-red-500 uppercase italic">
                                {{ $displayname }}
                            </div>
                        </div>
                    </label>
                    @endforeach

                    <label class="group cursor-pointer">
                        <input type="radio" name="avatar" value="nfsmw.jpg" class="hidden peer" checked>
                        <div class="relative overflow-hidden border border-gray-800 grayscale group-hover:grayscale-0 peer-checked:grayscale-0 peer-checked:border-red-600 transition-all duration-300">
                            <img src="{{ asset('images/avatars/nfsmw.jpg') }}" class="w-full h-24 object-cover" alt="Default">
                            <div class="absolute bottom-0 w-full bg-black/80 text-[9px] text-center text-gray-400 font-black tracking-tighter py-0.5 group-hover:text-red-500 peer-checked:text-red-500 uppercase italic">
                                Default
                            </div>
                        </div>
                    </label>

                </div>
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-900">
                <a class="underline text-xs text-gray-500 hover:text-gray-300 transition uppercase tracking-tighter font-bold italic" href="{{ route('login') }}">
                    {{ __('Abort to Login') }}
                </a>

                <x-primary-button class="ml-4 bg-red-700 hover:bg-red-600 text-white font-black italic tracking-widest px-6 rounded-none border border-red-500/30 transition shadow-[0_0_10px_rgba(185,28,28,0.3)]">
                    {{ __('Initialize Profile') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>