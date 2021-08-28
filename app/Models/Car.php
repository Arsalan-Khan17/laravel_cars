<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey  = 'id';

    protected $fillable = ['name','founded','description','image_path'];

    function carModel(){
        return $this->hasMany(carModel::class);
    }

    function engines(){
        return $this->hasManyThrough(
            Engine::class,
            carModel::class,
            'car_id', // Foriegn key on CarModel table 
            'model_id' // Foriegn key on Engine table
        );
    }

    public function productionDate(){
        return $this->hasOneThrough(
            CarProductionDate::class,
            carModel::class,
            'car_id',
            'model_id'
        );
    }

    public function products(){

        return $this->belongsToMany(Product::class);

    }

}
