<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Household>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Household::class;
    public function definition(): array
    {
        $rt = str_pad($this->faker->numberBetween(1, 5), 3, '0', STR_PAD_LEFT);
        $rw = str_pad($this->faker->numberBetween(1, 3), 3, '0', STR_PAD_LEFT);

        return [
            'nomor_kk' => $this->faker->unique()->numerify('35################'),
            'kepala_keluarga' => $this->faker->name('male' | 'female'),
            'alamat' => 'Jl. ' . $this->faker->streetName . ' No. ' . $this->faker->buildingNumber,
            'rt' => $rt,
            'rw' => $rw,
            'no_hp' => $this->faker->numerify('0812########'),
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
