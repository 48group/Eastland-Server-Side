<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping_list extends Model {

    protected $table = 'shopping_lists';

    protected $guarded = ['id'];

	public function item()
    {
        return $this->belongsToMany('App\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
