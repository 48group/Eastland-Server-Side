<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model {

	protected $table = 'cat';

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsToMany('App\Shop' , 'shop_cat' , 'shopId' , 'catId');
    }
}
