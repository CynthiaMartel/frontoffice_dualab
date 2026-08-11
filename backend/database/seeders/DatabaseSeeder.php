<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Familia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@microretos.es'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ],
        );

        $familias = [
            ['nombre' => 'Administración y Gestión',       'slug' => 'administracion-gestion',       'icono' => '💼', 'color_hex' => '#92400e', 'descripcion' => 'Retos de gestión empresarial, administración y recursos humanos'],
            ['nombre' => 'Comercio y Marketing',            'slug' => 'comercio-marketing',            'icono' => '🛍️', 'color_hex' => '#ea580c', 'descripcion' => 'Retos de ventas, marketing digital y gestión comercial'],
            ['nombre' => 'Informática y Comunicaciones',    'slug' => 'informatica-comunicaciones',    'icono' => '💻', 'color_hex' => '#1d4ed8', 'descripcion' => 'Retos de programación, desarrollo y tecnologías de la información'],
        ];

        Familia::query()->delete();

        foreach ($familias as $fData) {
            Familia::create($fData);
        }
    }
}
