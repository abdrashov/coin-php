<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCategoryRequest;
use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AccountCategoryController extends Controller
{
    public function index()
    {
        return Response::json([
            'accounts' => AccountCategory::get(),
        ]);
    }

    public function show(AccountCategory $account_category)
    {
        return Response::json([
            'account' => $account_category,
        ]);
    }

    public function store(AccountCategoryRequest $request)
    {
        AccountCategory::create($request->only('name', 'color', 'icon'));

        return Response::json([
            'success'   => true,
        ], 201);
    }

    public function update(AccountCategoryRequest $request, AccountCategory $account_category)
    {
        $account_category->update($request->only('name', 'color', 'icon'));
        
        return Response::json([
            'success'   => true,
        ], 202);
    }
}
