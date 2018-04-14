<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); //解除模型的批量填充限制
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        Model::reguard();
    }
}
