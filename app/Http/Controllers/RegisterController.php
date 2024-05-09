<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        // Log::info('Método __invoke chamado com sucesso.');
        Log::info('Request Data:', $request->all());

        $validated = $request->validated();

        $user = User::create($validated);

        UserRegistered::dispatch($user);

        return new UserResource($user);

        // return response()->json($user, 201);
    }
}
