<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'customer_phone'=>'279472947',
                'customer_address'=>'pannala',
                'national_id' =>'200112303770',
               'name'=>'Admin User',
               'email'=>'admin@itsolutionstuff.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
                'customer_phone'=>'279472947',
                'customer_address'=>'pannala',
                'national_id' =>'200112303771',
               'name'=>'User',
               'email'=>'user@itsolutionstuff.com',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}