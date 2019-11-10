<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Photo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'description', 'publish_date', 'photo_path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return ($this->publish_date <= date('Y-m-d H:i:s'));
    }

    /**
     * @param $query
     * @param Request $request
     * @return mixed
     */
    public static function scopeFilter($query, Request $request)
    {
        if ($request->status == 'published') {
            $query->published();
        }
        elseif ($request->status == 'not-published') {
            $query->notPublished();
        }
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopePublished($query)
    {
        return $query->where('publish_date', '<=', date('Y-m-d H:i:s'));
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeNotPublished($query)
    {
        return $query->where('publish_date', '>', date('Y-m-d H:i:s'));
    }

    public function hasOtherUser()
    {
        return ($this->user_id != auth()->id());
    }
}
