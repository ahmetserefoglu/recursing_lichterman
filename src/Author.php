<?php
namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Database\Eloquent\Model;

/**
* Model of the table tasks.
*/
class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'name'
    ];

    public function books(){
    	return $this->hasMany(Book::class);
    }
    
}