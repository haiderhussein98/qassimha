<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;



class ExpenseController extends Controller
{
    public function index() {
        return view('index');
    }

    public function calculate(Request $request)
{
    $names = $request->input('names');
    $amounts = $request->input('amounts');

    $total = array_sum($amounts);
    $count = count($amounts);
    $share = round($total / $count, 2);

    $people = [];

    foreach ($names as $index => $name) {
        $paid = $amounts[$index];
        $difference = round($paid - $share, 2);

        $people[] = [
            'name' => $name,
            'paid' => $paid,
            'difference' => $difference,
        ];
    }
     Expense::create([
        'names' => json_encode($names),
        'amounts' => json_encode($amounts),
        'total' => $total,
        'share' => $share,
    ]);

    return view('results', compact('people', 'total', 'share'));

    
}


    




public function analyze()
{
    $expenses = Expense::all();

    $monthlyTotals = [];

    foreach ($expenses as $expense) {
        $month = $expense->created_at->format('Y-m');
        if (!isset($monthlyTotals[$month])) {
            $monthlyTotals[$month] = 0;
        }
        $monthlyTotals[$month] += $expense->total;
    }

    return view('analyze', [
        'labels' => array_keys($monthlyTotals),
        'data' => array_values($monthlyTotals),
    ]);
}
public function showChart()
{
    $expenses = Expense::all();

    $monthlyTotals = [];

    foreach ($expenses as $expense) {
        $month = $expense->created_at->format('Y-m');
        if (!isset($monthlyTotals[$month])) {
            $monthlyTotals[$month] = 0;
        }
        $monthlyTotals[$month] += $expense->total;
    }

    $labels = array_keys($monthlyTotals);
    $data = array_values($monthlyTotals);

    return view('analyze', compact('labels', 'data'));
}

public function history()
{
    $expenses = Expense::orderByDesc('created_at')->get();

    $history = $expenses->map(function ($expense) {
        return [
            'id' => $expense->id, // مهم لزر الحذف
            'date' => $expense->created_at->format('Y-m-d'),
            'people' => count(json_decode($expense->names, true)),
            'amount' => $expense->total,
            'share' => $expense->share,
        ];
    });

    return view('history', ['history' => $history]);
}

public function destroy($id)
{
    $expense = Expense::findOrFail($id);
    $expense->delete();

    return redirect('/history')->with('success', 'تم حذف الفاتورة بنجاح.');
}

public function show($id)
{
    $expense = Expense::findOrFail($id);
    $names = json_decode($expense->names);
    $amounts = json_decode($expense->amounts);

    return view('expenses.show', compact('expense', 'names', 'amounts'));
}







public function downloadPDF($id)
{
    $expense = Expense::findOrFail($id);
    $names = json_decode($expense->names);
    $amounts = json_decode($expense->amounts);
    $share = $expense->share;

    $pdf =Pdf::loadView('expenses.pdf', compact('expense', 'names', 'amounts', 'share'));

    return $pdf->download("فاتورة رقم {$expense->id}.pdf");
}

    
}
