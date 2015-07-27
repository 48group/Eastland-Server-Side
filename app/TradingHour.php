<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TradingHour extends Model {

    protected $table = 'tradingHours';

    protected $fillable = ['tradingHours'];

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

}
