<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

    protected $fillable = ['name', 'info', 'place' , 'category' , 'picture' , 'userId'];

    protected $guarded = ['id'];

    protected $table = 'shops';

    public function cat()
    {
        return $this->belongsToMany('App\Shop' , 'shop_cat' , 'shopId' , 'catId');
    }

    public function tradingHour()
    {
        return $this->hasMany('App\Shop');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function item()
    {
        return $this->hasMany('App\Item');
    }

    public function event()
    {
        return $this->hasMany('App\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

//    public function phone()
//    {
//        return $this->hasMany('App\Phone');
//    }
}
