<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'birthday', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public static function getTableName()
    {
        return (new self)->getTable();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * @param $query
     * @param Request $request
     * @return mixed
     */
    public static function scopeAdminFilter($query, Request $request)
    {
        if ($search = $request->search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($gender = $request->gender) {
            $query->where('gender', $gender);
        }

        if ($startAge = $request->start_age) {
            $query->where('birthday', '<=', date((date('Y') - $startAge) . '-m-d'));
        }

        if ($endAge = $request->end_age) {
            $query->where('birthday', '>=', date((date('Y') - $endAge) . '-m-d'));
        }

        return $query;
    }
}
