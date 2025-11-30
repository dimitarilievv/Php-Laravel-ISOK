<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'mechanic_first_name',
        'mechanic_last_name',
        'client_first_name',
        'client_last_name',
        'brand',
        'model',
        'licence_number',
        'description',
        'price',
        'received_at',
        'finished_at',
    ];

    protected $casts = [
        'received_at' => 'date',
        'finished_at' => 'date',
        'price' => 'decimal:2',
    ];

    public function mechanicFullName()
    {
        return $this->mechanic_first_name . ' ' . $this->mechanic_last_name;
    }

    public function clientFullName()
    {
        return $this->client_first_name . ' ' . $this->client_last_name;
    }
}
