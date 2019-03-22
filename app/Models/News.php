<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = ['title', 'image','sub_images', 'content', 'category_id'];


    /**
     * Get Category of a specific news
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
