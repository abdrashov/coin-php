<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use App\Models\IncomeTransaction;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{
    public function index()
    {
        return Response::json([
            'cash' => IncomeTransaction::sum('cash') / 100,
            'accounts' => AccountCategory::with('incomeTransaction')->get()->transform(fn ($account) => [
                'id' => $account->id,
                'name' => $account->name,
                'color' => $account->color,
                'icon' => $account->icon,
                'cash' => $account->incomeTransaction->sum('cash') / 100,
            ]),
        ]);
    }
}
