<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction_detail;
use App\Models\Orders;



class transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transaction';

    // protected $primaryKey = 'transaction_id'; 

    protected $fillable = [
        'transaction_id', 'name', 'company_name', 'status'        
    ];

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id', 'transaction_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'transaction_id', 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

}
