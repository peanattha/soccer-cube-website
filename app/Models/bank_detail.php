<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bank_detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function banks()
    {
        return $this->hasMany(bank::class,'bank_detail_id','id');
    }

}
