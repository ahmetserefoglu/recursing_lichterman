<?php

namespace AhmetSerefoglu\RecursingLichterman\Book;
namespace AhmetSerefoglu\RecursingLichterman\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class,20)->create();
        factory(User::class,20)->create();
    }
}
