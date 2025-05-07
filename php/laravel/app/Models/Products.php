<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\SoftDeletes;
/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;// SoftDeletes;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
