@extends('layouts.app')

@section('title', 'تحليل المصاريف')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen px-4 py-10">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-3xl p-8 space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-green-700 mb-2">📊 تحليل المصاريف</h1>
            <p class="text-gray-600 text-sm">رسم بياني يوضح المصاريف الشهرية المُسجلة</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl shadow-inner">
            <canvas id="expensesChart" height="120"></canvas>
        </div>

        <a href="/" class="block text-center w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-xl transition">
            ← العودة للصفحة الرئيسية
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('expensesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'إجمالي المصاريف (دينار)',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(34,197,94,0.8)',
                borderRadius: 10,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: { font: { size: 12 } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { font: { size: 12 } },
                    grid: { borderDash: [5, 5] }
                }
            }
        }
    });
</script>
@endsection
