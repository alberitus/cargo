<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    protected $table = 'transaction_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_id', 'item_id', 'amount', 'price', 'tax', 'total_price'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id',);
    }

}
