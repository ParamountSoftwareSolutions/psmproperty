<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingExpense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function labor()
    {
        return $this->hasOne(BuildingExpenseLabor::class, 'building_expense_id');
    }

    public function getTotal()
    {
        $total = 0;
        foreach($this->items as $data)
        {
            $total += ($data->price );
        }

        return $total;
    }

}
