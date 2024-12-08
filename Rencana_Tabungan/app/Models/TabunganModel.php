<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganModel extends Model
{
    use HasFactory;

    protected $table = 'tabungan';
    protected $primaryKey = 'id_tabungan';

    protected $fillable = [
        'id_user',
        'judul_tabungan',
        'foto',
        'target_nominal',
        'target_tanggal',
        'nominal',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }

    public function menabung()
    {
        return $this->hasMany(MenabungModel::class, 'id_tabungan');
    }
}
