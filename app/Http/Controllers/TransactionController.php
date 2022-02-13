<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionSetExpenseRequest;
use App\Http\Requests\TransactionSetIcomeRequest;
use App\Models\AccountCategory;
use App\Models\ExpenseCategory;
use App\Models\ExpenseTransactions;
use App\Models\IncomeCategory;
use App\Models\IncomeTransaction;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    public function setIncome(AccountCategory $account_category, IncomeCategory $income_category, TransactionSetIcomeRequest $request)
    {
        IncomeTransaction::create([
            'account_category_id' => $account_category->id,
            'income_category_id' => $income_category->id,
            'cash' => $request->input('cash'),
        ]);

        return Response::json([
            'success'   => true,
        ], 201);
    }

    public function setExpense(IncomeCategory $income_category, ExpenseCategory $expense_category, TransactionSetExpenseRequest $request)
    {
        ExpenseTransactions::create([
            'income_category_id' => $income_category->id,
            'expense_category_id' => $expense_category->id,
            'cash' => $request->input('cash'),
        ]);

        return Response::json([
            'success'   => true,
        ], 201);
    }
}
