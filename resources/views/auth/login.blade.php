@extends('layouts.frontend')

@section('title', 'Sign In')

@section('content')
<div class="max-w-md mx-auto my-16 px-4">
    <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-lg space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-bold text-2xl mx-auto shadow-md">
                SD
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Masuk ke Akun Anda</h1>
            <p class="text-slate-500 text-xs sm:text-sm">Gunakan email & password Anda untuk masuk ke sistem manajemen.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-700 p-4 rounded-xl text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <p>⚠️ {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Alamat Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" placeholder="contoh: admin@snackdist.com"
                    class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            </div>

            <div>
                <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Password</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                    class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-md transition">
                    Masuk Sekarang
                </button>
            </div>
        </form>

        <!-- Credentials Helper Box -->
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 text-[11px] text-amber-800 space-y-2.5">
            <p class="font-bold flex items-center gap-1">🔑 Akun Demo (Seeder):</p>
            <div class="space-y-1">
                <div>
                    <span class="font-bold text-slate-700">1. Admin Gudang:</span> 
                    <code class="bg-amber-100 px-1 py-0.5 rounded">admin@snackdist.com</code> / <code class="bg-amber-100 px-1 py-0.5 rounded">password123</code>
                </div>
                <div>
                    <span class="font-bold text-slate-700">2. Agen Ritel Makmur:</span> 
                    <code class="bg-amber-100 px-1 py-0.5 rounded">agen@snackdist.com</code> / <code class="bg-amber-100 px-1 py-0.5 rounded">password123</code>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
