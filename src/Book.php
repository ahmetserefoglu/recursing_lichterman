<?php
namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Database\Eloquent\Model;

/**
* Model of the table tasks.
*/
class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'name','publisher'
    ];

    public function users(){
    	return $this->belongsToMany(User::class,'books_users','books_users','books_id','user_id');
    }

    public function authors(){
    	return $this->belongsTo(Author::class);
    }

    public function labels(){
        return $this->belongsTo(Label::class);
    }
    
}