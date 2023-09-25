<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    // Защита от массового присвоения
    protected $fillable = ['user_name', 'email', 'home_page', 'text', 'parent_id'];

    /**`
     * Получить родительский комментарий.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Comments', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Comments', 'parent_id');
    }

}
