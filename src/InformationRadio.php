<?php
namespace jlaucho\conection_ubiquiti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformationRadio extends Model
{
    use softDeletes;
    protected $table = 'devices';
    protected $fillable = [
        'MAC', 'model_device', 'user_device', 'password_device', 'status_device', 'payload'
    ];

}
