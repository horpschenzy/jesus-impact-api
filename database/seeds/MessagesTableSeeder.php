<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Message::class, 100)->create();
    }
}
