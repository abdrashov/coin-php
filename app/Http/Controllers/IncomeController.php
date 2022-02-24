<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use App\Models\ExpenseTransactions;
use App\Models\IncomeTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class IncomeController extends Controller
{
    public function index()
    {
        return Response::json([
            'incomes' => IncomeTransaction::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), 'income_category_id', DB::raw('SUM(cash) as cash_sum'))
                ->groupBy('year', 'month', 'income_category_id')
                ->when(Request::input('date') ?? null, fn ($query, $date) => $query->whereBetween('created_at', [(new Carbon($date))->startOfMonth()->format('Y-m-d H:i:s'), (new Carbon($date))->endOfMonth()->format('Y-m-d H:i:s')]))
                ->get()
                ->transform(fn ($income) => [
                    'income_id' => $income->income->id,
                    'income_name' => $income->income->name,
                    'income_icon' => $income->income->icon,
                    'income_color' => $income->income->color,
                    'cash_sum' => $income->cash_sum  / 100,
                ]),
        ]);
    }
}
