<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class additems extends Model
{
    use HasFactory;
    protected $table='additems';
    protected $primaryKey='id';
    protected $fillable=['restaurant_name','food_name','description','price','image_path'];
}
