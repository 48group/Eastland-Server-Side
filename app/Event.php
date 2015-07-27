<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $fillable = ['startDate', 'endDate' , 'place', 'info' , 'picture' , 'category' , 'shopId'];

    protected $guarded = ['id'];

    protected $table = 'events';

    protected $dates = ['date'];

	public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date);
    }


}
