@extends('layouts.app')

@section('title', '📜 تاريخ الفواتير')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white shadow-xl rounded-3xl p-8 mt-10 space-y-6">
    <h2 class="text-2xl font-bold text-green-700 text-center">📜 تاريخ الفواتير السابقة</h2>

    @forelse($expenses as $expense)
        @php
            $names = json_decode($expense->names);
            $amounts = json_decode($expense->amounts);
            $count = count($names);
            $share = $expense->share;
        @endphp

        <!-- ✅ الكرت بالكامل قابل للنقر -->
        <a href="{{ route('expenses.show', $expense->id) }}"
           class="block border border-gray-200 rounded-xl p-4 shadow-sm space-y-4 bg-gray-50 hover:bg-gray-100 transition duration-200 cursor-pointer">

            <div class="flex justify-between text-sm text-gray-600">
                <span>📅 التاريخ: {{ $expense->created_at->format('Y-m-d') }}</span>
                <span>👥 عدد الأشخاص: {{ $count }}</span>
            </div>

            <table class="w-full text-sm text-right border">
                <thead>
                    <tr class="bg-green-100 text-green-900">
                        <th class="p-2">الاسم</th>
                        <th class="p-2">دفع</th>
                        <th class="p-2">الفرق</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($names as $index => $name)
                        @php
                            $paid = $amounts[$index];
                            $diff = $paid - $share;
                        @endphp
                        <tr>
                            <td class="p-2 font-medium">{{ $name }}</td>
                            <td class="p-2">{{ $paid }} د.ع</td>
                            <td class="p-2">
                                @if($diff > 0)
                                    <span class="text-green-600">له {{ number_format($diff, 2) }} د.ع</span>
                                @elseif($diff < 0)
                                    <span class="text-red-600">عليه {{ number_format(abs($diff), 2) }} د.ع</span>
                                @else
                                    <span class="text-gray-500">متعادل</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center text-sm text-gray-700">
                <strong>📌 الحصة العادلة لكل شخص:</strong> {{ number_format($share, 2) }} دينار
                &nbsp;|&nbsp;
                <strong>💰 مجموع الفاتورة:</strong> {{ number_format($expense->total, 2) }} دينار
            </div>
        </a>
    @empty
        <p class="text-center text-gray-500">لا توجد فواتير محفوظة حالياً.</p>
    @endforelse

    <div class="text-center pt-4">
        <a href="/" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-xl transition">
            ← العودة للصفحة الرئيسية
        </a>
    </div>
</div>
@endsection
