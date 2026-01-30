<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

    $nombres = ['Laptop', 'Smartphone', 'Tablet', 'Monitor', 'Teclado', 'Mouse', 'Impresora', 'Cámara', 'Auriculares', 'Altavoz'];
    $descripcionesCortas = [
        'Producto de alta calidad',
        'Última tecnología',
        'Diseño moderno y elegante',
        'Ideal para el trabajo y el hogar',
        'Fácil de usar y configurar',
        'Duradero y resistente',
        'Excelente rendimiento',
        'Ligero y portátil',
        'Compatible con múltiples dispositivos',
        'Garantía incluida'
    ];
    $descripcionesLargas = [
        'Este producto ofrece características avanzadas y un rendimiento excepcional para satisfacer todas sus necesidades.',
        'Fabricado con materiales de alta calidad, garantiza durabilidad y eficiencia en el uso diario.',
        'Su diseño innovador lo convierte en la mejor opción para quienes buscan funcionalidad y estilo.',
        'Perfecto para profesionales y usuarios domésticos que requieren tecnología confiable.',
        'Incluye garantía y soporte técnico para una experiencia sin preocupaciones.'
    ];

    return [
        'categoria_id' => \App\Models\Categoria::inRandomOrder()->first()->id,
        'nombre' => $nombre = $this->faker->unique()->randomElement($nombres),
        'codigo' => strtoupper($this->faker->unique()->bothify('PROD-####')),
        'descripcion_corta' => $this->faker->randomElement($descripcionesCortas),
        'descripcion_larga' => $this->faker->randomElement($descripcionesLargas),
        'precio_compra' => $this->faker->randomFloat(2, 10, 1500),
        'precio_venta' => $this->faker->randomFloat(2, 20, 2000),
        'stock' => $this->faker->numberBetween(0, 100),
    ];
    }
}
