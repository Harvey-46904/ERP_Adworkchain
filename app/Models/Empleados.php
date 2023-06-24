<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'Nombre_completo',
        'Cedula',
        'Cargo',
        'Fecha_ingreso',
        'Fecha_finalizacion',
        'Email',
        'Telefono_personal',
        'Contacto_emergencia',
        'Numero_contacto_emergencia',
    ];
}
