<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenabungModel extends Model
{
    use HasFactory;

    protected $table = 'menabung';
    protected $primaryKey = 'id_menabung';

    protected $fillable = [
        'id_tabungan',
        'id_user',
        'nominal',
        'tanggal_menabung',
    ];

    public function tabungan()
    {
        return $this->belongsTo(TabunganModel::class, 'id_tabungan');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }
}
