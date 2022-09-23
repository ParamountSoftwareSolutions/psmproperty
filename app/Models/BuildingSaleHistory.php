<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BuildingSale;

class BuildingSaleHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building_sale()
    {
        return $this->belongsTo(BuildingSale::class, 'building_sale_id')->with('floor_detail');
    }

    public function user($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }


}
