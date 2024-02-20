<?php

namespace App\Models;

use App\Models\PaketModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer';
    protected $primaryKey = 'id_customer';
    protected $fillable = ['nama', 'alamat', 'no_hp', 'id_paket', 'foto_ktp', 'foto_rumah'];
    public function paket()
    {
        return $this->belongsTo(PaketModel::class, 'id_paket', 'id_paket');
    }
}
