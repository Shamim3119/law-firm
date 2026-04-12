<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 
/**
 * @property int $id
 * @property string $title
 * @property string $descriptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cases extends Model
{
    protected $fillable = ['title', 'descriptions']; 
}
