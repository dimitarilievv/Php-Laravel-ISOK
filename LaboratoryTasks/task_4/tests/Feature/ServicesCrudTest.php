<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Service;

class ServicesCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_loads(): void
    {
        $response = $this->get('/services');
        $response->assertOk();
    }

    public function test_can_create_service(): void
    {
        $payload = [
            'mechanic_first_name' => 'Игор',
            'mechanic_last_name' => 'Стојанов',
            'client_first_name' => 'Ана',
            'client_last_name' => 'Илиевска',
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'licence_number' => 'SK-1234-AB',
            'description' => 'Промена на масло и филтер',
            'price' => 1500.50,
            'received_at' => now()->format('Y-m-d'),
            'finished_at' => now()->format('Y-m-d'),
        ];

        $response = $this->post('/services', $payload);
        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', [
            'client_first_name' => 'Ана',
            'brand' => 'Toyota',
        ]);
    }

    public function test_can_update_service(): void
    {
        $service = Service::factory()->create();

        $response = $this->put("/services/{$service->id}", [
            'mechanic_first_name' => 'Игор',
            'mechanic_last_name' => 'Стојанов',
            'client_first_name' => 'Ана',
            'client_last_name' => 'Илиевска',
            'brand' => 'VW',
            'model' => 'Golf',
            'licence_number' => 'SK-0000-AA',
            'description' => 'Дијагностика',
            'price' => 999.99,
            'received_at' => now()->format('Y-m-d'),
            'finished_at' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'brand' => 'VW',
            'model' => 'Golf',
        ]);
    }

    public function test_can_delete_service(): void
    {
        $service = Service::factory()->create();

        $response = $this->delete("/services/{$service->id}");
        $response->assertRedirect('/services');
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }
}

