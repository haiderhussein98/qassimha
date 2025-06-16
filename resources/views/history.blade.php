@extends('layouts.app')

@section('title', '📑 سجل الفواتير')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-white shadow-xl rounded-3xl p-6 mt-10 space-y-6">
    <h2 class="text-2xl font-bold text-green-700 text-center">📑 سجل الفواتير</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 text-sm text-center rounded p-3">
            {{ session('success') }}
        </div>
    @endif

    @if (count($history) > 0)
        <div class="space-y-4">
            @foreach ($history as $item)
                <div class="relative">
                    <a href="{{ route('expenses.show', $item['id']) }}"
                       class="block border border-gray-200 rounded-xl p-4 shadow-sm bg-gray-50 hover:bg-gray-100 transition duration-200">
                        
                        <!-- بيانات الفاتورة -->
                        <div class="text-sm text-gray-700 space-y-1">
                            <div><span class="font-semibold">📆 التاريخ:</span> {{ $item['date'] }}</div>
                            <div><span class="font-semibold">👥 عدد الأشخاص:</span> {{ $item['people'] }}</div>
                            <div><span class="font-semibold">💰 المبلغ الكلي:</span> {{ $item['amount'] }} دينار</div>
                            <div><span class="font-semibold">📤 الحصة:</span> {{ $item['share'] }} دينار</div>
                        </div>
                    </a>

                    <!-- زر الحذف فوق الكرت -->
                    <form action="{{ url('/expenses/' . $item['id']) }}" method="POST" class="absolute top-2 left-2 z-10">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('هل أنت متأكد من حذف هذه الفاتورة؟')"
                                class="text-red-600 hover:text-red-800 text-xs font-semibold">
                            🗑️ حذف
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center">لا توجد فواتير محفوظة بعد.</p>
    @endif

    <div class="text-center pt-4">
        <a href="{{ url('/') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-xl transition">
            ← الرجوع للصفحة الرئيسية
        </a>
    </div>
</div>
@endsection
