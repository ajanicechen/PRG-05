<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Character
 *
 * @property int $id
 * @property string $name
 * @property int $vision_id
 * @property string $lore
 * @property string $portrait
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @property-read int|null $user_count
 * @property-read \App\Models\Vision $vision
 * @method static \Database\Factories\CharacterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereLore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character wherePortrait($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereVisionId($value)
 * @mixin \Eloquent
 */
class Character extends Model
{

    use HasFactory;
    protected $table = 'characters';
    protected $fillable = [
        'name',
        'vision_id',
        'lore',
        'portrait'
    ];

    public function user():BelongsToMany{
        return $this->belongsToMany(User::class, 'character_user');
    }

    public function vision(){
        return $this->belongsTo(Vision::Class, 'vision_id');
    }
}
