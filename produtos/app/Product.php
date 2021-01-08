<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function interests() {
        return $this->hasMany('App\ProductInterest');
    }

    public function getActiveAttribute($value) {
        return $value == true;
    }
}
