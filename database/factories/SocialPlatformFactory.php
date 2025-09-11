<?php

namespace Modules\Base\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Base\Models\SocialPlatform;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Base\Models\SocialPlatform>
 */
class SocialPlatformFactory extends Factory
{
    protected $model = SocialPlatform::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'url' => $this->faker->url(),
            'icon' => $this->faker->randomElement(['facebook', 'twitter', 'instagram', 'linkedin', 'youtube']),
            'priority' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean(80),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
