<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BuildingSaleHistory;

class BuildingSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id')->with('building_floor_detail');
    }

    public function floor_detail()
    {
        return $this->belongsTo(FloorDetail::class, 'floor_detail_id')->with('building', 'floor');
    }

    public function sale_person()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->with('country', 'state', 'city');
    }

    public function property_admin()
    {
        return $this->belongsTo(User::class, 'property_admin_id');
    }

    public function sale_detail()
    {
        return $this->hasOne(BuildingSaleDetail::class, 'building_sale_id');
    }

    public function building_installment()
    {
        return $this->hasMany(BuildingSaleInstallment::class, 'building_sale_id');
    }

    public function building_installment_single()
    {
        return $this->hasOne(BuildingSaleInstallment::class, 'building_sale_id')->where('status', '=', 'not_paid');
    }

    public function building_installment_paid()
    {
        return $this->hasMany(BuildingSaleInstallment::class, 'building_sale_id')->where('status', '=', 'paid');
    }

    public function payment()
    {
        return $this->belongsTo(BuildingPaymentPlan::class, 'payment_plan_id');
    }

    public function building_sale_history()
    {
        return $this->hasMany(BuildingSaleHistory::class);
    }
}
