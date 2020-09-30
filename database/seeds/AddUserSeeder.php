<?php

use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = new \App\User;
        $user1->username = "ripin";
        $user1->name = "ripin";
        $user1->email = "ripin@mail.com";
        $user1->password = \Hash::make("ripin");
        $user1->level ="staff";
        $user1->save();

        $user2 = new \App\User;
        $user2->username = "roro";
        $user2->name = "roro";
        $user2->email = "roro@mail.com";
        $user2->password = \Hash::make("roro");
        $user2->level ="staff";
        $user2->save();

        $user3 = new \App\User;
        $user3->username = "riri";
        $user3->name = "riri";
        $user3->email = "riri@mail.com";
        $user3->password = \Hash::make("riri");
        $user3->level ="staff";
        $user3->save();
        $this->command->info("User ripin berhasil dibuat");
    }
}
