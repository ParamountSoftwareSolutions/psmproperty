<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function property_admin()
    {
        return $this->belongsTo(User::class, 'property_admin_id');
    }

    public function building_employee()
    {
        return $this->hasOne(BuildingEmployee::class, 'user_id')->with('sale_manager');
    }

    public static function admin_building($admin_id)
    {
        $building_assign = BuildingAssignUser::where('user_id', $admin_id)->get();
        return Building::whereIn('id', $building_assign->pluck('building_id')->toArray())->get();
    }

    public function building_employee_payroll()
    {
        return $this->hasOne(BuildingEmployeePayRoll::class, 'user_id');
    }

    public function Societies(){
        return $this->hasMany(Society::class, 'user_id');
    }

    public function Society(){
        return $this->hasOne(Society::class, 'assign_id');
    }

    public function Client(){
        return $this->hasOne(Client::class, 'user_id');
    }

    public function Agent(){
        return $this->hasOne(Agent::class, 'user_id');
    }

    public function Employee(){
        return $this->hasOne(SocietyEmployee::class, 'user_id');
    }

    public function Apartments(){
        return $this->hasMany(AgentApartment::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
	 public function assignee()
    {
        return $this->hasMany(BuildingSale::class);
    }
}
