<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_factory_make_has_name()
    {
        $category = Category::factory()->make();
        $this->assertNotEmpty($category->name);
        $this->assertIsString($category->name);
    }

    public function test_category_factory_create_persists()
    {
        $category = Category::factory()->create();
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name,
        ]);
    }
}

