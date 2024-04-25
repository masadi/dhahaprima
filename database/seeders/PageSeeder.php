<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'email' => 'admin@dhahaprima.id'
            ],
            [
                'name' => 'Administrator',
                'password' => bcrypt('#B1mill4h@')
            ],
        );
        if(!$user->hasRole('admin')){
            $user->addRole($role);
        }
        $pages = [
            [
                'title' => 'Home',
                'content' => 'Home Content',
            ],
            [
                'title' => 'Profile',
                'content' => 'Profile Content',
            ],
            [
                'title' => 'Products',
                'content' => 'Products Content',
            ],
            [
                'title' => 'Contact Us',
                'content' => 'Contact Us Content',
            ],
        ];
        DB::table('pages')->truncate();
        foreach($pages as $page){
            Page::create([
                'title' => $page['title'],
                'content' => $page['content'],
            ]);
        }
    }
}
