<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bank extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function bank_detail()
    {
        return $this->belongsTo(bank_detail::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
