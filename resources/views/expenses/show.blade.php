@extends('layouts.app')

@section('title', '📄 تفاصيل الفاتورة')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-white shadow-xl rounded-3xl p-8 mt-10 space-y-6">
    <h2 class="text-2xl font-bold text-green-700 text-center">📄 تفاصيل الفاتورة</h2>

    <div class="text-sm text-gray-600 text-center">
        <div><span class="font-semibold">📅 التاريخ:</span> {{ $expense->created_at->format('Y-m-d H:i') }}</div>
        <div><span class="font-semibold">💰 المبلغ الكلي:</span> {{ number_format($expense->total, 2) }} دينار</div>
        <div><span class="font-semibold">📤 الحصة لكل شخص:</span> {{ number_format($expense->share, 2) }} دينار</div>
    </div>

    <table class="w-full text-sm text-right border mt-6">
        <thead>
            <tr class="bg-green-100 text-green-900">
                <th class="p-2">الاسم</th>
                <th class="p-2">المبلغ المدفوع</th>
                <th class="p-2">الفرق</th>
            </tr>
        </thead>
        <tbody>
            @foreach($names as $index => $name)
                @php
                    $paid = $amounts[$index];
                    $diff = $paid - $expense->share;
                @endphp
                <tr>
                    <td class="p-2 font-medium">{{ $name }}</td>
                    <td class="p-2">{{ number_format($paid, 2) }} د.ع</td>
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

    <!-- الأزرار -->
    <div class="flex justify-center gap-4 pt-6">
    <button disabled
        class="inline-block bg-gray-400 text-white font-semibold py-2 px-6 rounded-xl cursor-not-allowed opacity-50">
        📥 تحميل PDF (قريبًا)
    </button>

    <a href="{{ route('expenses.history') }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-xl transition">
        ← الرجوع للسجل
    </a>
</div>

</div>
@endsection
