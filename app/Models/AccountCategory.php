<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'icon', 'color'
    ];

    public function incomeTransaction()
    {
        return $this->hasMany(IncomeTransaction::class, 'account_category_id');
    }
}
