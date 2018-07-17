<?php

use App\Region;
use App\Trainer;
use App\Level;
use App\Formation;
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
        $this->call(TrainerTableSeeder::class);
        $this->call(FormationTableSeeder::class);
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

class TrainerTableSeeder extends Seeder
{
    /**
     * Seed the user's table.
     *
     * @return void
     */
  public function run()
    {
        Trainer::create(
          [
            'first_name' => 'Pierre',
            'last_name' => 'Martin',
            //'pseudo' => 'pmartin',
            'rank' => 'Sergent',
            'speciality' => 'Pompier',
            'level_id' => 1,
            'region_id' => 2
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Jacques',
            'last_name' => 'Leroux',
            //'pseudo' => 'jleroux',
            'rank' => 'Commandant',
            'speciality' => 'Pompier',
            'level_id' => 2,
            'region_id' => 9
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Nathalie',
            'last_name' => 'Moreaux',
            //'pseudo' => 'nmoreaux',
            'rank' => 'Assistant Médico-Administratif (AMA) de classe normale',
            'speciality' => 'SAMU',
            'level_id' => 1,
            'region_id' => 3
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Zoé',
            'last_name' => 'Richard',
            //'pseudo' => 'zrichard',
            'rank' => 'Assistant Médico-Administratif (AMA) de classe exceptionnelle',
            'speciality' => 'SAMU',
            'level_id' => 3,
            'region_id' => 2
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Laurent',
            'last_name' => 'Dubois',
            //'pseudo' => 'ldubois',
            'rank' => 'Chef de service',
            'speciality' => 'Médecin',
            'level_id' => 4,
            'region_id' => 11
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Clément',
            'last_name' => 'Durant',
            //'pseudo' => 'cdurant',
            'rank' => 'Capitaine',
            'speciality' => 'Police',
            'level_id' => 3,
            'region_id' => 2
          ]
        );
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
            'password' => '$2y$10$cRj0nd/4HyP5Vx6sVHwwpOe0qAnlKIW/UY/pf8sDibMHPS.hiDme6',
            'role' => 'admin'
          ]
        );
        User::create(
          [
            'email' => 'martin@gmail.com',
            'password' => '$2y$10$cRj0nd/4HyP5Vx6sVHwwpOe0qAnlKIW/UY/pf8sDibMHPS.hiDme6',
            'trainer_id' => 1
          ]
        );
        User::create(
          [
            'email' => 'jacques@gmail.com',
            'password' => '$2y$10$t8EhzbsZp8ISuGOHyjJBl.Dhf4AQHtLSNJQOOy7mZufg6PZ8ULmFS',
            'trainer_id' => 2
          ]
        );
        User::create(
          [
            'email' => 'nathalie@gmail.com',
            'password' => '$2y$10$kW0Tz.t9/a/ZQIQBVDD6M.P2p9rRztWMyh15Vjzhyz1pdPh8WORsS',
            'trainer_id' => 3
          ]
        );
        User::create(
          [
            'email' => 'zoe@gmail.com',
            'password' => '$2y$10$iGsowG9RCv50gORU8G01we4lIM9mtgCN3q4xDny7tKz4FZdBhfZ3C',
            'trainer_id' => 4
          ]
        );
        User::create(
          [
            'email' => 'laurent@gmail.com',
            'password' => '$2y$10$eo.o3Dnzd8sA46V/7a8b/.moz5h6NkAMx0HVxocWhe13P7XYLMJmq',
            'trainer_id' => 5
          ]
        );
        User::create(
          [
            'email' => 'clement@gmail.com',
            'password' => '$2y$10$fUmhcZxRno7mY2X6PDZIx.MzuNfbc18pem9r6O2hxZluBJbLVJtn6',
            'trainer_id' => 6
          ]
        );
    }
}

class FormationTableSeeder extends Seeder
{
    /**
     * Seed the region's table.
     *
     * @return void
     */
    public function run()
    {
        Formation::create(
          [
            'name' => 'Formation n°1',
            'place' => 'Rue de la Liberté 21000 DIJON',
            'date_start' => '2018-07-19',
            'time_start' => '09:00:00',
            'date_end' => '2018-07-20',
            'time_end' => '18:00:00',
            'number_of_trainers' => 0,
            'number_of_assistant_trainers' => 2,
            'number_of_instructors' => 0,
            'number_of_course_directors' => 1,
            'educational_objective' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin lacus odio, blandit in consectetur eu, varius a ipsum. Etiam efficitur, magna eget fermentum accumsan, orci nisl aliquet purus, non hendrerit ipsum sapien in ex. Donec interdum, velit cursus blandit volutpat, mauris erat blandit felis, in euismod diam tellus lobortis felis. Vestibulum nunc neque, sagittis eget est quis, laoreet eleifend dolor. Quisque aliquet sed nulla vitae ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vestibulum lectus vitae urna porta, nec pretium tortor cursus. Donec ut laoreet est. Nullam venenatis enim non diam tristique vehicula. Nunc massa lacus, finibus quis odio eu, euismod consectetur nunc. Etiam eu urna ante. Duis eu vestibulum eros, at condimentum nisi. Etiam consectetur tincidunt tortor, id porttitor nunc mattis ac. Pellentesque urna nulla, dictum a tristique sit amet, egestas sed odio. Suspendisse tempor neque quis magna mollis, vitae molestie sapien dignissim. Aliquam imperdiet feugiat risus, ut vulputate justo elementum et. ",
            'send_email' => false
          ]
        );
        Formation::create(
          [
            'name' => 'Formation n°2',
            'place' => 'Rue Monge 21000 DIJON',
            'date_start' => '2018-06-19',
            'time_start' => '09:00:00',
            'date_end' => '2018-06-20',
            'time_end' => '18:00:00',
            'number_of_trainers' => 2,
            'number_of_assistant_trainers' => 1,
            'number_of_instructors' => 1,
            'number_of_course_directors' => 1,
            'educational_objective' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin lacus odio, blandit in consectetur eu, varius a ipsum. Etiam efficitur, magna eget fermentum accumsan, orci nisl aliquet purus, non hendrerit ipsum sapien in ex. Donec interdum, velit cursus blandit volutpat, mauris erat blandit felis, in euismod diam tellus lobortis felis. Vestibulum nunc neque, sagittis eget est quis, laoreet eleifend dolor. Quisque aliquet sed nulla vitae ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vestibulum lectus vitae urna porta, nec pretium tortor cursus. Donec ut laoreet est. Nullam venenatis enim non diam tristique vehicula. Nunc massa lacus, finibus quis odio eu, euismod consectetur nunc. Etiam eu urna ante. Duis eu vestibulum eros, at condimentum nisi. Etiam consectetur tincidunt tortor, id porttitor nunc mattis ac. Pellentesque urna nulla, dictum a tristique sit amet, egestas sed odio. Suspendisse tempor neque quis magna mollis, vitae molestie sapien dignissim. Aliquam imperdiet feugiat risus, ut vulputate justo elementum et. ",
            'send_email' => false
          ]
        );
    }
}
