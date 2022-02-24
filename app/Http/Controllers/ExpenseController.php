<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use App\Models\ExpenseTransactions;
use Illuminate\Support\Facades\Response;

class ExpenseController extends Controller
{
    public function index()
    {
        return Response::json([
            'expenses' => ExpenseTransactions::selectRaw('expense_category_id, SUM(cash) as cash_sum')
                ->groupBy('expense_category_id')
                ->get()
                ->transform(fn ($expense) => [
                    'expense_id' => $expense->expense->id,
                    'expense_name' => $expense->expense->name,
                    'expense_icon' => $expense->expense->icon,
                    'expense_color' => $expense->expense->color,
                    'cash_sum' => $expense->cash_sum  / 100
                ]),
            // 'expenses' => ExpenseTransactions::orderByDesc('created_at')->with(['expense', 'income'])->get()->transform(fn ($expense) => [
            //     'id' => $expense->id,
            //     'expense_name' => $expense->expense->name,
            //     'expense_icon' => $expense->expense->icon,
            //     'expense_color' => $expense->expense->color,
            //     'income_name' => $expense->income->name,
            //     'income_icon' => $expense->income->icon,
            //     'income_color' => $expense->income->color,
            //     'cash' => $expense->cash
            // ]),
        ]);
    }
}
