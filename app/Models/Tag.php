<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];
    /**
     * Get the posts for the user.
     */
    public function blogs()
    {
        return $this->belongsToMany('App\Models\Blog');
    }
}