<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Kategorija::class, 21)->create();
        factory(App\User::class, 15)->create()->each(function ($u) {
            $u->teme()->saveMany(factory(App\Tema::class, 25)->make());  
        });
        $users = App\User::all();

        foreach ($users as $user) {
            $dir_name="public/".$user->slug;
            Storage::makeDirectory($dir_name, 0775);
            factory(App\Komentar::class, 250)->create(['user_id' => $user->id]);
        }
    }
}
