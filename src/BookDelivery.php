<?php
namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Database\Eloquent\Model;

/**
* Model of the table tasks.
*/
class BookDelivery extends Model
{
    protected $table = 'books_delivery';

    protected $fillable = [
        'books','delivery'
    ];
    
}