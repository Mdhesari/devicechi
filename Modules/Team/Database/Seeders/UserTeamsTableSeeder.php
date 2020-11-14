<?php

namespace Modules\Team\Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $users = config('team.users');

        foreach ($users as $key => $user) {

            $users[$key]['password'] = Hash::make($user['password']);
        }

        DB::table('users')->insert($users);
    }
}
