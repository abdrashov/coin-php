<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_category_id', 'expense_category_id', 'cash'
    ];

    public function expense()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function income()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }
}
