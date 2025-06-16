@extends('layouts.app')

@section('title', 'نتائج التقسيم')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-6 space-y-6">

        <h2 class="text-2xl font-bold text-green-700 text-center">نتائج التقسيم</h2>

        <table class="w-full text-sm text-right border">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-2">الاسم</th>
                    <th class="p-2">دفع</th>
                    <th class="p-2">الفرق</th>
                </tr>
            </thead>
            <tbody>
                @foreach($people as $person)
                    <tr>
                        <td class="p-2 font-medium">{{ $person['name'] }}</td>
                        <td class="p-2">{{ $person['paid'] }} د.ع</td>
                        <td class="p-2">
                            @if($person['difference'] > 0)
                                <span class="text-green-600">له {{ $person['difference'] }} د.ع</span>
                            @elseif($person['difference'] < 0)
                                <span class="text-red-600">عليه {{ abs($person['difference']) }} د.ع</span>
                            @else
                                <span class="text-gray-500">متعادل</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-green-100 text-green-900 rounded-lg p-4 text-center font-semibold">
            مجموع الفاتورة: {{ $total }} دينار<br>
            الحصة العادلة لكل شخص: {{ $share }} دينار
        </div>

        <a href="/" class="mt-6 inline-block text-center w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 rounded-lg transition">
            ← العودة
        </a>
    </div>
</div>
@endsection
