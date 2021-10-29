<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Vision
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\VisionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Vision filter()
 * @method static \Illuminate\Database\Eloquent\Builder|Vision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vision query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vision whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vision whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Vision extends Model
{
    use HasFactory;
    protected $table = 'visions';
    protected $fillable = [
        'name'
    ];

    public function character(){
        return $this->hasMany(Character::class);
    }
}
