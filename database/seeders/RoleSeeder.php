<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();

        $data = [
            [
                'name'       => 'Administator',
                'slug'       => 'administator',
                'primary'    => 1,
                'premium'    => 1,
                'bg_color'   => '#bf1616',
                'text_color' => '#ffffff',
                'icon'       => 'user-secret',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Moderator',
                'slug'       => 'moderator',
                'primary'    => 1,
                'premium'    => 1,
                'bg_color'   => '#2dab1a',
                'text_color' => '#ffffff',
                'icon'       => 'user-shield',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Dosen',
                'slug'       => 'dosen',
                'primary'    => 1,
                'premium'    => 1,
                'bg_color'   => '#6c12ce',
                'text_color' => '#ffffff',
                'icon'       => 'user-tie',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Mahasiswa',
                'slug'       => 'mahasiswa',
                'primary'    => 1,
                'premium'    => 0,
                'bg_color'   => '#1292ce',
                'text_color' => '#ffffff',
                'icon'       => 'user-graduate',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Member',
                'slug'       => 'member',
                'primary'    => 1,
                'premium'    => 0,
                'bg_color'   => '#1292ce',
                'text_color' => '#ffffff',
                'icon'       => 'user',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Banned',
                'slug'       => 'banned',
                'primary'    => 1,
                'premium'    => 0,
                'bg_color'   => '#3e3e3e',
                'text_color' => '#9a9a9a',
                'icon'       => 'banned',
                'candelete'  => 0,
            ],
            [
                'name'       => 'Premium',
                'slug'       => 'premium',
                'primary'    => 1,
                'premium'    => 1,
                'bg_color'   => '#c99356',
                'text_color' => '#ffffff',
                'icon'       => 'star',
                'candelete'  => 1,
            ],
        ];

        Role::insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
