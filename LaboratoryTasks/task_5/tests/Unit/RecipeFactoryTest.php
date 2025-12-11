<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_recipe_factory_make_has_fields()
    {
        $recipe = Recipe::factory()->make();
        $this->assertNotEmpty($recipe->title);
        $this->assertNotEmpty($recipe->description);
        $this->assertTrue(strlen($recipe->description) >= 50);
        $this->assertNotEmpty($recipe->ingredients);
        $this->assertIsString($recipe->ingredients);
    }

    public function test_recipe_factory_create_persists_and_links_category()
    {
        $recipe = Recipe::factory()->create();
        $this->assertDatabaseHas('recipes', [
            'id' => $recipe->id,
            'title' => $recipe->title,
        ]);

        $this->assertNotNull($recipe->category_id);
        $this->assertNotNull($recipe->category);
        $this->assertNotEmpty($recipe->category->name);
    }
}

