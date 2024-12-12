<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'model', 'launchDate', 'price', 'color', 'user_id'];

    // Getter and Setter for Brand
    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }


    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model){
        $this->model = $model;
    }


    // Getter and Setter for Launch Date
    public function getLaunchDate()
    {
        return $this->launchDate;
    }

    public function setLaunchDate($launchDate)
    {
        $this->launchDate = $launchDate;
    }

    // Getter and Setter for Price
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    // Getter and Setter for Color
    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

}
