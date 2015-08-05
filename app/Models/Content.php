<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 8:23 PM
 */

namespace App\Models;

use App\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'publish_at', 'active', 'caption', 'description', 'text'];

    /**
     * @var array
     */
    protected $dates = ['publish_at'];

    /**
     * @var array
     */
    protected $appends = ['url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        $category = ($this->category) ? $this->category->url : '';

        return $category.'/'.$this->id.'-'.Slug::make($this->caption);
    }
}