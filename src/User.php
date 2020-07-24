<?php
namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Database\Eloquent\Model;

/**
* Model of the table tasks.
*/
class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name','email'
    ];

    public function book(){
    	return $this->belongsToMany(Book::class,'books_users','books_id','user_id');
    }
    
}