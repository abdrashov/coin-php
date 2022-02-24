<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_category_id', 'income_category_id', 'cash'
    ];

    public function account()
    {
        return $this->belongsTo(AccountCategory::class, 'account_category_id');
    }

    public function income()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }
}
