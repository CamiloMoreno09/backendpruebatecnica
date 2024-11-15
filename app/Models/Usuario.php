<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    use HasApiTokens, HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla en SQL Server
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = false; // No usar timestamps de Laravel

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    // Define si la clave primaria es un entero
    protected $keyType = 'int';

    // Cambia el nombre del campo para la autenticación
    public function getAuthPassword()
    {
        return $this->password;
    }
}
