<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$QsS0rAUkwZBvdsiWdDqececxd2RIxS6dwKNgMkpL1681h4dOwbnEy', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'kamailo', 'email' => 'asdf@asdf.com', 'password' => '$2y$10$iFPQU2H1JoBJE8.7UYfwceAkVfzxI8Qxj6U33306PR0ZDgHh89VQq', 'role_id' => 1, 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
