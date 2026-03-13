<?php

namespace App\Http\Controllers\Api;

use App\Support\ApiFormatter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routine\StoreRequest;
use App\Http\Requests\Routine\UpdateRequest;
use App\Services\RoutineService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoutineController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new RoutineService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $routines = $this->service->index($request);

        return response()->json(
            ApiFormatter::response('', 200, $routines)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ] = $this->service->store($request);

        return response()->json(
            ApiFormatter::response($message, $status, $data),
            $status
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $routine = $this->service->show($request, $id);

        if (!$routine) {
            return response()->json(
                ApiFormatter::response('Rutina no encontrada', 404, null),
                404
            );
        }

        return response()->json(
            ApiFormatter::response('Rutina obtenida exitosamente', 200, $routine)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        [
            'data' => $data,
            'status' => $status,
            'message' => $message
        ] = $this->service->update($request, $id);

        return response()->json(
            ApiFormatter::response($message, $status, $data),
            $status
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ] = $this->service->destroy($id);

        return response()->json(
            ApiFormatter::response($message, $status, $data),
            $status
        );
    }
}
