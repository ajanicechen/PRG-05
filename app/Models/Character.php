<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{

    use HasFactory;
    protected $table = 'characters';
    protected $fillable = [
        'charName',
        'charVision',
        'charLore',
        'charPortrait'
    ];

    public function user():BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
