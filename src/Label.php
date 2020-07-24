<?php
namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Database\Eloquent\Model;

/**
* Model of the table tasks.
*/
class Label extends Model
{
    protected $table = 'labels';

    protected $fillable = [
        'label_no','books_id'
    ];

    public function books(){
    	return $this->hasOne(Book::class);
    }
    
}