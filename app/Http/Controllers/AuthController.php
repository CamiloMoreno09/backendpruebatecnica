<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    // Validación de los datos
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Obtiene las credenciales 
    $credentials = $request->only('email', 'password');

    // Verificar si el usuario existe
    $user = Usuario::where('email', $request->email)->first();
    
    if ($user) {
        // Verifica que la contraseña ingresada coincida con la almacenada en la base de datos
        if (Hash::check($request->password, $user->password)) {
            // Si las credenciales son correctas, devuelve un mensaje de éxito
            return response()->json(['message' => 'Login exitoso'], 200);
        } else {
            // Si la contraseña no coincide
            return response()->json(['error' => 'Las credenciales no coinciden con nuestros registros.'], 401);
        }
    } else {
        return response()->json(['error' => 'Las credenciales no coinciden con nuestros registros.'], 401);
    }
}

public function register(Request $request)
{
   
    // Crear el usuario
    $data = $request->all();
    $data['password'] = Hash::make($request->password); // Hasheamos la contraseña

    // Guardamos al usuario en la base de datos
    $usuario = Usuario::create($data);

    // Si el usuario se crea correctamente, devuelve un mensaje de  éxito
    return response()->json([
        'message' => 'Usuario creado exitosamente',
        'user' => $usuario
    ], 201); 
}


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
