<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

// الصفحة الرئيسية
Route::get('/', [ExpenseController::class, 'index'])->name('home');

// حساب التقسيم
Route::post('/calculate', [ExpenseController::class, 'calculate'])->name('calculate');

// عرض سجل الفواتير
Route::get('/history', [ExpenseController::class, 'history'])->name('expenses.history');

// تحليل البيانات (رسم بياني)
Route::get('/analyze', [ExpenseController::class, 'analyze'])->name('analyze');

// حذف فاتورة
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

// عرض تفاصيل فاتورة واحدة
Route::get('/expenses/{id}', [ExpenseController::class, 'show'])->name('expenses.show');

Route::get('/expenses/{id}/pdf', [ExpenseController::class, 'downloadPDF'])->name('expenses.pdf');


use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/test-pdf', function () {
    $html = '<html><body style="direction: rtl; font-family: DejaVu Sans;">مرحبا بك</body></html>';
    return Pdf::loadHTML($html)->download('test.pdf');
});




Route::get('/test-pdf', function () {
    return Pdf::loadView('test')->stream();
});
