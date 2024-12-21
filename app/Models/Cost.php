<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $table = 'cost';

    protected $primaryKey = 'cost_id';

    protected $fillable = [
        'transaction_id', 'nama_item', 'amount', 'price', 'total_cost', 'gross_profit', 'pph', 'profit',
    ];
}
