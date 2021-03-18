<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class user extends Model
{
  //
  protected $table ='users';
  public $fillable = ['jobid','name','email','password','authority'];
}