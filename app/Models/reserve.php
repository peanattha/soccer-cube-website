<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reserve extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function stadium()
    {
        return $this->belongsTo(stadium::class);
    }
    public function payment()
    {
        return $this->belongsTo(payment::class);
    }
}
