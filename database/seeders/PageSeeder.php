<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::updateOrCreate([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Administrator Akses',
        ]);
        $user = User::updateOrCreate(
            [
                'email' => 'admin@email.com'
            ],
            [
                'name' => 'Administrator',
                'password' => bcrypt('#B1mill4h@')
            ],
        );
        if(!$user->hasRole('admin')){
            $user->addRole($role);
        }
        $find = Page::first();
        if(!$find){
            Page::create([
                'title' => 'Home',
                'content' => 'Home Content',
            ]);
            Page::create([
                'title' => 'About',
                'content' => 'About Content',
            ]);
        }
    }
}
