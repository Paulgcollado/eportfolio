<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();

        // llamadas a otros ficheros de seed
        $this->call(FamiliasProfesionalesTableSeeder::class);
        $this->call(CiclosFormativosTableSeeder::class);
        $this->call(ResultadosAprendizajeTableSeeder::class);
        $this->call(CriteriosEvaluacionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TareasTableSeeder::class);
        $this->call(EvidenciasTableSeeder::class);
        $this->call(EvaluacionesEvidenciasTableSeeder::class);
        // llamadas a otros ficheros de seed

        Model::reguard();
        Schema::enableForeignKeyConstraints();
    }
}
