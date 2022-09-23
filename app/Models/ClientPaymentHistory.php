<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPaymentHistory extends Model
{
    use HasFactory;

    protected $table= "client_payment_history";

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
