<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TradingHour extends Model {

    protected $table = 'trading_hours';

    protected $fillable = ['shopId','monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

}
