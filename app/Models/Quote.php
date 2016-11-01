<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $table = "quotes";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'created_at',
		'updated_at',
		'text',
		'author',
		'background',

    ];

    public static $rules = [
        // create rules
    ];

    // Quote 

}
