<x-app-layout>
    <div class="mb-8 p-6 bg-gradient-to-r from-slate-800/80 via-slate-800 to-indigo-950/30 rounded-xl border border-slate-700/50 shadow-md">
        <h1 class="text-xl md:text-2xl lg:text-3xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-indigo-300 leading-tight">
            Formal Image Classification & Multimedia Metadata Management System
        </h1>
    </div>
    
    <div class="bg-slate-800 rounded-xl shadow-lg border border-slate-700/60 p-6 mb-8">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Image Upload
        </h3>
        
        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            @error('image')
                <div class="p-4 bg-red-950/40 border border-red-500/40 rounded-xl flex items-center gap-3 text-red-400 text-sm font-semibold transition shadow-inner">
                    <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <!-- 🟢 TAMBAH AYAT DI SINI -->
            <div class="mb-4 p-4 bg-slate-900/60 border border-slate-700/50 rounded-xl">
            <div class="flex items-center gap-2 mb-3">
                <span class="flex h-2 w-2 rounded-full bg-indigo-400"></span>
                <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-400">Kriteria Imej Formal (Standard):</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                <!-- Lajur Kiri -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 bg-slate-800/50 rounded-lg border border-slate-700/30">
                        <span class="text-slate-400 font-medium">Background Color</span>
                        <span class="px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-800 rounded text-[10px] font-bold uppercase">Plain White / Blue</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-slate-800/50 rounded-lg border border-slate-700/30">
                        <span class="text-slate-400 font-medium">Clothes</span>
                        <span class="px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-800 rounded text-[10px] font-bold uppercase">Kemeja / Blazer / Baju Kurung</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-slate-800/50 rounded-lg border border-slate-700/30">
                        <span class="text-slate-400 font-medium">Face Alignment</span>
                        <span class="px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-800 rounded text-[10px] font-bold uppercase">Center</span>
                    </div>
                </div>

                <!-- Lajur Kanan -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 bg-slate-800/50 rounded-lg border border-slate-700/30">
                        <span class="text-slate-400 font-medium">Camera Posture</span>
                        <span class="px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-800 rounded text-[10px] font-bold uppercase">Facing Camera</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-slate-800/50 rounded-lg border border-slate-700/30">
                        <span class="text-slate-400 font-medium">Body Composition</span>
                        <span class="px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-800 rounded text-[10px] font-bold uppercase">Half Body</span>
                    </div>
                </div>
            </div>
        </div>

            <div class="p-8 bg-slate-900/50 border border-dashed border-slate-700 rounded-xl transition hover:border-slate-600 flex flex-col items-center justify-center text-center">
                <svg class="w-12 h-12 text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <input type="file" name="image" required class="block text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 file:cursor-pointer transition">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-indigo-500/20 transition duration-150 transform active:scale-[0.99]">
                Analyze Image
            </button>
        </form>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            Recent Uploaded Images
        </h3>

        <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search" 
                class="bg-slate-900 border border-slate-700 text-white rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
            
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                Search
            </button>

            @if(request()->filled('search'))
                <a href="{{ route('dashboard') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg text-sm transition flex items-center">
                    Clear
                </a>
            @endif
        </form>
    </div>
        
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($images as $img)
            <div class="bg-slate-800 border border-slate-700/70 rounded-xl overflow-hidden shadow-md flex flex-col group">
                
                <div class="relative h-52 w-full bg-slate-900 overflow-hidden">
                    <a href="{{ route('result.show', $img->image_ID) }}">
                        <img src="{{ asset('storage/' . $img->file_name) }}" 
                             class="h-full w-full object-cover object-center transition duration-300 group-hover:scale-105"
                             alt="Uploaded Profile Picture">
                    </a>
                </div>
                
                <div class="p-3 bg-slate-800/90 border-b border-slate-700/50 flex justify-between items-center">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider">
                            Owner: {{ $img->user->username ?? 'External Student' }}
                        </span>
                    </div>
                    
                    <a href="{{ route('result.show', $img->image_ID) }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition flex items-center gap-1">
                        View Analysis 
                    </a>
                </div>

                <div class="p-4 space-y-3 max-h-40 overflow-y-auto bg-slate-900/30 flex-grow">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Comment</h4>
                    
                    @forelse($img->tags as $tag)
                        @php 
                            $commenter = \App\Models\User::find($tag->pivot->user_ID);
                        @endphp
                        <div class="text-xs bg-slate-900/50 rounded-lg p-2.5 border border-slate-700/40">
                            <span class="font-bold text-indigo-400 block mb-0.5">
                                {{ $commenter ? $commenter->username : 'System Core' }}
                            </span>
                            <p class="text-slate-300 leading-relaxed">{{ $tag->tag_name }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 italic">No comment</p>
                    @endforelse
                </div>

                <form action="{{ route('tags.store') }}" method="POST" class="p-3 bg-slate-900/20 border-t border-slate-700/40 flex gap-2">
                    @csrf
                    <input type="hidden" name="image_ID" value="{{ $img->image_ID }}">
                    <input type="text" name="tag_name" placeholder="Comment here" required
                           class="flex-1 text-xs p-2 rounded bg-slate-700 border border-slate-600 text-white placeholder-slate-400 focus:outline-none focus:border-indigo-500 transition">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs font-bold transition">
                        Add
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full bg-slate-800/40 border border-dashed border-slate-700/60 rounded-xl p-12 text-center">
                <p class="text-slate-500 font-medium">No uploaded images</p>
            </div>
        @endforelse
    </div>
</x-app-layout>