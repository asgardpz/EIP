<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class restaurant extends Model
{
  //
  protected $table ='restaurant';
  public $fillable = ['restaurant_type','restaurant_plant','restaurant_meal','restaurant_time','restaurant_name','restaurant_1','restaurant_2','restaurant_logo','restaurant_menu','restaurant_phone','restaurant_address'];
}