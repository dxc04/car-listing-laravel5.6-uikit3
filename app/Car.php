<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Faker\Provider\CarData as CarData;

class Car extends Model
{
    protected $fillable = ['make', 'model', 'year', 'price', 'body_type', 'fuel_type', 'transmission', 'description'];

    public static function getDefaultMakeAndModel()
    {
        $cars = CarData::getBrandsWithModels();
        $make = ['Honda', 'Toyota', 'Nissan', 'Hyundai', 'Kia', 'Ford', 'Jeep', 'Chevrolet', 'Audi', 'Volvo', 'BMW'];
        $make_model = [];
        foreach($make as $brand) {
            $make_model[$brand] = $cars[$brand];
        }
        return $make_model;
    }
}
