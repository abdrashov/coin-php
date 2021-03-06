<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Response;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        return Response::json([
            'expenses' => ExpenseCategory::get()->transform(fn ($expense) => [
                'id' => $expense->id,
                'name' => $expense->name,
                'icon' => $expense->icon,
                'color' => $expense->color
            ]),
        ]);
    }

    public function show(ExpenseCategory $expense_category)
    {
        return Response::json([
            'expense' => $expense_category,
        ]);
    }

    public function store(ExpenseCategoryRequest $request)
    {
        ExpenseCategory::create($request->only('name', 'color', 'icon'));

        return Response::json([
            'success'   => true,
        ], 201);
    }

    public function update(ExpenseCategoryRequest $request, ExpenseCategory $expense_category)
    {
        $expense_category->update($request->only('name', 'color', 'icon'));
        
        return Response::json([
            'success'   => true,
        ], 202);
    }
}
