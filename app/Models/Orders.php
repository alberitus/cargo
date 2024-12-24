<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'orders_id';

    protected $fillable = [
        'transaction_id', 'job_type', 'job_no', 'job_ref', 'flight_date', 'destination', 'mawb', 'hawb', 'consigne', 'shipper', 'detail'
    ];
}
