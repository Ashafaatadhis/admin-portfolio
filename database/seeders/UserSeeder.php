<?php
namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Adhis Mauliyahsa Ashafaat",
            'email' => "ashafaatadhis@gmail.com",
            'password' => Hash::make('adhis123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
