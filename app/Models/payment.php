<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function reserves()
    {
        return $this->hasOne(reserve::class,'payment_id','id');
    }

}
