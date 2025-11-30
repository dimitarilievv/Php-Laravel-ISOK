<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderByDesc('created_at')->get();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = new Service();
        return view('services.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Сервисирањето е успешно додадено.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $data = $this->validatedData($request);
        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Сервисирањето е успешно ажурирано.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Сервисирањето е успешно избришано.');
    }

    /**
     * Validate request data for creating/updating a service.
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'mechanic_first_name' => ['required', 'string', 'max:255'],
            'mechanic_last_name' => ['required', 'string', 'max:255'],
            'client_first_name' => ['required', 'string', 'max:255'],
            'client_last_name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'licence_number' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'received_at' => ['required', 'date'],
            'finished_at' => ['nullable', 'date', 'after_or_equal:received_at'],
        ]);
    }
}

