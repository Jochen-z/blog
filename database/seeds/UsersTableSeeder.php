<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->makeVisible(['password', 'remember_token']);
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = '$2y$10$Iwt1Bq4kJfxOcBpmfsAqYu9hhGoTaHl/J3ld0tGVJobQtByCxt3ry'; # 123456
        $user->remember_token = str_random(10);
        $user->save();
    }
}
