<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];

    /**
     * Get News of a specific Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news(){
        return $this->belongsTo('App\Models\News', 'category_id', 'id');
    }
}
