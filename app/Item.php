<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    protected $fillable = ['name', 'price', 'info' , 'picture' , 'shopId'];

    protected $guarded = ['id'];

    protected $table = 'items';

	public function shopping_list()
    {
        return $this->belongsToMany('App\Shopping_lists')->withTimestamps();
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

}
