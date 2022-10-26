<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingSaleInstallment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function building_sale()
    {
        return $this->belongsTo(BuildingSale::class, 'building_sale_id')->with('floor_detail', 'customer');
    }
}
