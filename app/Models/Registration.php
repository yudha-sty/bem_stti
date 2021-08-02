<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaLengkap',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'nim',
        'programStudi',
        'semester',
        'tahunAngkatan',
        'noTelepon',
        'mottoHidup',
        'motivasiBEM',
        'email',
        'asalSekolah',
        'foto',
        'swafoto',
        'pengalamanOrganisasi',
        'statusTerima'
    ];
}
