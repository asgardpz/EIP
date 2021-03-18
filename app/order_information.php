<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class order_information extends Model
{
  //
  protected $table ='order_information';
  public $fillable = ['inf_type','inf_plant','inf_meal','inf_time','inf_1','inf_2','inf_3','inf_4','inf_5'];
}