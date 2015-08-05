<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 8:21 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['caption', 'active', 'slug'];

    /**
     * @var array
     */
    protected $appends = ['url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content()
    {
        return $this->hasMany('App\Models\Content');
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return '/'.$this->slug;
    }
}