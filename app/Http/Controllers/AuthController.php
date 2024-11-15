<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener las credenciales del request
        $credentials = $request->only('email', 'password');

        // Verificar si el usuario existe
        $user = Usuario::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // El usuario existe y la contraseña es correcta
            // Generar un token
            $token = $user->createToken('MyApp')->plainTextToken;

            // Devolver la respuesta con el token
            return response()->json([
                'message' => 'Login exitoso',
                'token' => $token,
            ], 200);
        }

        // Si las credenciales no coinciden
        return response()->json(['error' => 'Las credenciales no coinciden con nuestros registros.'], 401);
    }

    // Registro de usuario
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
    public function logout(Request $request)
    {
        // Eliminar el token del usuario
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Usuario desconectado correctamente'], 200);
    }
}
