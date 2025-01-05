<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    protected $table = 'transaction_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_id', 'nama_item', 'amount', 'price', 'tax', 'tax_price',  'total_price'
    ];

    public function scopeLatestByJobType($query, $jobType)
    {
        return $query->where('job_no', 'LIKE', '%/' . $jobType . '/%')
                    ->latest('created_at')
                    ->first();
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id',);
    }

}
