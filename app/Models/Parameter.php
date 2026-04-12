<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
/**
 * @property int $id
 * @property string $name
 * @property string $tag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Parameter extends Model
{
    protected $fillable = ['name', 'tag'];
    protected $table = 'parameters';
    
}
