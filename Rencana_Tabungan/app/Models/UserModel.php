<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function tabungan()
    {
        return $this->hasMany(TabunganModel::class, 'id_user');
    }

    public function menabung()
    {
        return $this->hasMany(MenabungModel::class, 'id_user');
    }
}
