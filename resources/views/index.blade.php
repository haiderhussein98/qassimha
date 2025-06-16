@extends('layouts.app')

@section('title', 'قسّم المبلغ')

@section('content')
<div class="w-full max-w-2xl mx-auto bg-white shadow-xl rounded-3xl p-8 space-y-8 mt-10">
    <div class="text-center">
        <h2 class="text-3xl font-extrabold text-green-700">قسّمها</h2>
        <p class="text-gray-600 mt-2">أدخل أسماء الأشخاص والمبالغ التي دفعوها لتقسيم المصاريف بسهولة</p>
    </div>

    <form action="{{ url('/calculate') }}" method="POST" id="expense-form" class="space-y-4">
        @csrf

        <div id="people-container" class="space-y-4">
            <div class="person-entry grid grid-cols-12 gap-3 items-center">
                <div class="col-span-7">
                    <label class="block text-sm text-gray-700 mb-1">الاسم</label>
                    <input type="text" name="names[]" placeholder="مثلاً: أحمد"
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
                </div>
                <div class="col-span-5">
                    <label class="block text-sm text-gray-700 mb-1">المبلغ المدفوع</label>
                    <input type="number" name="amounts[]" placeholder="مثلاً: 5000"
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
                </div>
            </div>
        </div>

        <div class="flex justify-between gap-4 pt-4">
            <button type="button" onclick="addPerson()"
                class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold py-2 rounded-xl transition text-sm">
                + أضف شخص آخر
            </button>

            <button type="submit"
                class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-xl transition text-sm">
                💰 احسب المبالغ
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function addPerson() {
        const container = document.getElementById('people-container');
        const entry = document.createElement('div');
        entry.className = 'person-entry grid grid-cols-12 gap-3 items-center';

        entry.innerHTML = `
            <div class="col-span-7">
                <label class="block text-sm text-gray-700 mb-1">الاسم</label>
                <input type="text" name="names[]" placeholder="مثلاً: فاطمة"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
            </div>
            <div class="col-span-5">
                <label class="block text-sm text-gray-700 mb-1">المبلغ المدفوع</label>
                <input type="number" name="amounts[]" placeholder="مثلاً: 7500"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
            </div>
        `;
        container.appendChild(entry);
    }
</script>
@endsection
