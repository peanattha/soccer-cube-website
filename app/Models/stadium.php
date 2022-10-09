<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stadium extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'stadiums';

    public function reserves()
    {
        return $this->hasMany(reserve::class,'stadium_id','id');
    }
}
