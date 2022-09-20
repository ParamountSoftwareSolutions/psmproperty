<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function labor()
    {
        return $this->hasOne(ExpenseLabor::class, 'expense_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
