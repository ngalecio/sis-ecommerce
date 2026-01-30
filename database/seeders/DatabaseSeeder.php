<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Usuario']);

        User::factory()->create([
            'name' => 'super admin',
            'email' => 'correo@correo.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');
        Ajuste::create([
            'nombre' => 'Dr. Hair Salon',
            'descripcion' => 'Descripción de la aplicación',
            'sucursal' => 'Sucursal Principal',
            'direccion' => 'Calle 123',
            'telefonos' => '555-1234',
            'email' => 'correo@ejemplo.com',
            'divisa' => 'USD',
            'pagina_web' => 'http://www.ejemplo.com',
            'logo' => 'logos/WJvdhus9I1hcDmg3xL8U6ctq972WcJVIxvYdseVd.png',
            'imagen_login' => 'imagen_login/eWwKfk5sdq6RBLUQk9Gr9E2mREir2KMCsBB0kJOq.jpg',
        ]);
       

        Categoria::factory(10)->create();
        Producto::factory(10)->create();
    }
}
