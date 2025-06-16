<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'قسّمها')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- ✅ Header ظاهر في كل الصفحات -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <h1 class="text-xl font-bold text-green-700">
                <a href="/">قسّمها</a>
            </h1>
            <nav class="flex gap-4 text-sm font-medium">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600 transition">🏠 الصفحة الرئيسية</a>
                <a href="{{ url('/analyze') }}" class="text-gray-700 hover:text-green-600 transition">📊 التحليل</a>
                <a href="{{ url('/history') }}" class="text-gray-700 hover:text-green-600 transition">📜 الفواتير السابقة</a>
            </nav>
        </div>
    </header>

    <!-- ✅ Main content -->
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
