<?php

namespace App\Application\Website\Controllers;

use App\Infrastructure\Laravel\Models\User;
use App\Domain\Shared\Lang\Models;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $viaCepService;

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request, ViaCepService $viaCepService)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'age' => 'required|integer|min:18',
        'email' => 'required|email|unique:users,email',
        'cep' => 'required|string|size:8',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => 'Erro de validação!',
            'message' => $validator->errors(),
        ], 400);
    }

    $addressData = $viaCepService->getAddressByCep($request->cep);

    if (!$addressData || $addressData['uf'] !== 'AM') {
        return response()->json(['message' => 'CEP inválido ou não é do Amazonas']);
    }

    $user = new User();
    $user->name = $request->name;
    $user->age = $request->age;
    $user->email = $request->email;
    $user->cep = $request->cep;
    $user->save();

    return response()->json(['message' => 'Usuário criado!']);
}

    public function update(Request $request, $id, ViaCepService $viaCepService)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'age' => 'required|integer|min:18',
        'email' => 'required|email|unique:users,email,' . $id,
        'cep' => 'required|string|size:8',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => 'Erro de validação!',
            'message' => $validator->errors(),
        ], 400);
    }

    $addressData = $viaCepService->getAddressByCep($request->cep);

    if (!$addressData || $addressData['uf'] !== 'AM') {
        return response()->json(['message' => 'CEP inválido ou não percente ao estado do Amazonas']);
    }

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuário não encontrado!']);
    }

    $user->name = $request->name;
    $user->age = $request->age;
    $user->email = $request->email;
    $user->cep = $request->cep;
    $user->save();

    return response()->json(['message' => 'Dados atualizados!']);
}
}



