<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeCategoryRequest;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\Response;

class IncomeCategoryController extends Controller
{
    public function index()
    {
        return Response::json([
            'incomes' => IncomeCategory::get(),
        ]);
    }

    public function show(IncomeCategory $income_category)
    {
        return Response::json([
            'income' => $income_category,
        ]);
    }

    public function store(IncomeCategoryRequest $request)
    {
        IncomeCategory::create($request->only('name', 'color', 'icon'));

        return Response::json([
            'success'   => true,
        ], 201);
    }

    public function update(IncomeCategoryRequest $request, IncomeCategory $income_category)
    {
        $income_category->update($request->only('name', 'color', 'icon'));
        
        return Response::json([
            'success'   => true,
        ], 202);
    }
}
