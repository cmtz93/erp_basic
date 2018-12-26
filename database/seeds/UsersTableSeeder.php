<?php

use Illuminate\Database\Seeder;
use App\{User, Role, Permision};

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$a = Role::create(["name" => "admin", "display_name" => "Administrador"]);
        //$u = Role::create(["name" => "user", "display_name" => "Usuario"]);

        User::create([
        	"firstname" => "Carlos",
        	"lastname" => "Martinez",
	        'email' => "mtz677@gmail.com", 
	        'password' => bcrypt("secret"), 
	        'username' => "mtz677", 
	        'status' => 1,
        ]);
    }
}
