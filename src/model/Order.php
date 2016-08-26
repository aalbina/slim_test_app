<?php
/**
 * Created by PhpStorm.
 * User: albina
 * Date: 26.08.16
 * Time: 15:51
 */

class Order extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'birth', 'inn', 'type'];
}