<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastModification extends Model {

    protected $fillable = ['date'];

    protected $guarded = ['id'];

    protected $table = 'last_modifications';

}
