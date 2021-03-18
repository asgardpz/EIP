<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class order_menu extends Model
{
  //
  protected $table ='order_menu';
  public $fillable = ['menu_type','menu_plant','menu_meal','menu_restaurant','menu_item','menu_money'];
}