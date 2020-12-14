<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $route = 'food';

    protected $fillable = [
        'name',
        'fat',
        'saturated_fat',
        'carbohydrate',
        'sugar',
        'protein',
        'animal',
    ];

    public function getRoute()
    {
        return $this->id ? $this->route . '/' . $this->id : $this->route;
    }

    public function getBaseRoute()
    {
        return $this->route;
    }
}
