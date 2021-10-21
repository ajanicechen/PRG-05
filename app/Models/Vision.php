<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vision extends Model
{
    use HasFactory;
    protected $table = 'visions';

    public function character():BelongsToMany{
        return $this->belongsToMany(Character::class);
    }
}
