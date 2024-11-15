<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Indicar que no usaremos timestamps automáticos si no es necesario
    protected $table = 'posts'; // Nombre de la tabla en SQL Server
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['title', 'content', 'user_id', 'category'];

    // Relación con el modelo Usuario
    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
