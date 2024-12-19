<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consigne extends Model
{
    use HasFactory;

    protected $table = 'consigne';

    protected $primaryKey = 'consigne_id';
}
