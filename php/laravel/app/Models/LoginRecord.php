<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginRecord whereUserId($value)
 * @mixin \Eloquent
 */
class LoginRecord extends Model
{
    protected $fillable = ['user_id', 'ip_address', 'user_agent'];
}
