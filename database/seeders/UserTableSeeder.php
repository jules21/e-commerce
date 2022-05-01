<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =
        User::create(
        [
            'id'=>1,
            'email'=>'admin@ecommerce.com',
            'name' =>'admin',
            'is_admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        //create default account for registered user
        Account::create([
            'user_id'=>$user->id,
            'account_number'=>'21212-212312-' . rand(1,5000),
        ]);
    }
}
