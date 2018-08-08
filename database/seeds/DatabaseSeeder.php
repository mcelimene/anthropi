<?php

use App\Region;
use App\Level;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LevelTableSeeder::class);
    }
}

class RegionTableSeeder extends Seeder
{
    /**
     * Seed the region's table.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['name' => 'Auvergne-Rhône-Alpes']);
        Region::create(['name' => 'Bourgogne-Franche-Comté']);
        Region::create(['name' => 'Bretagne']);
        Region::create(['name' => 'Centre-Val de Loire']);
        Region::create(['name' => 'Corse']);
        Region::create(['name' => 'Grand-Est']);
        Region::create(['name' => 'Hauts-de-France']);
        Region::create(['name' => 'Île-de-France']);
        Region::create(['name' => 'Normandie']);
        Region::create(['name' => 'Nouvelle-Aquitaine']);
        Region::create(['name' => 'Occitanie']);
        Region::create(['name' => 'Pays de la Loire']);
        Region::create(['name' => "Provence-Alpes-Côte d'Azur"]);
        Region::create(['name' => 'Guadeloupe']);
        Region::create(['name' => 'Guyane (française)']);
        Region::create(['name' => 'Martinique']);
        Region::create(['name' => 'La Réunion']);
        Region::create(['name' => 'Mayotte']);
    }
}

class LevelTableSeeder extends Seeder
{
    /**
     * Seed the region's table.
     *
     * @return void
     */
    public function run()
    {
        Level::create(['name' => 'Assistant-formateur']);
        Level::create(['name' => 'Formateur']);
        Level::create(['name' => 'Instructeur']);
        Level::create(['name' => 'Directeur de cours']);
    }
}


class UserTableSeeder extends Seeder
{
    /**
     * Seed the user's table.
     *
     * @return void
     */
  public function run()
    {
        User::create(
          [
            'name' => 'Administrateur',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$ftPXgH1obzWN6CC1qWhBrexaydguU8h0Zpu0MLXeMjXnApsuEf2CC',
            'role' => 'admin'
          ]
        );
        User::create(
          [
            'name' => 'Datadock',
            'email' => 'contact@data-dock.fr',
            'password' => '$2y$10$ftPXgH1obzWN6CC1qWhBrexaydguU8h0Zpu0MLXeMjXnApsuEf2CC',
            'role' => 'datadock'
          ]
        );
    }
}
