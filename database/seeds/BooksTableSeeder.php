<?php

use Illuminate\Database\Seeder;
use App\Model\Books;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Books::class)->times(30)->create(); 
    }
}
