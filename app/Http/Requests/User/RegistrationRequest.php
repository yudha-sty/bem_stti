<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                $rules = [
                    'namaLengkap'           => 'required|alpha',
                    'tempatLahir'           => 'required',
                    'tanggalLahir'          => 'required|before:today',
                    'jenisKelamin'          => 'required',
                    'nim'                   => 'required|numeric|digits_between:5,10',
                    'programStudi'          => 'required',
                    'semester'              => 'required|numeric',
                    'tahunAngkatan'         => 'required',
                    'noTelepon'             => 'required|digits_between:0,13',
                    'mottoHidup'            => 'required',
                    'motivasiBEM'           => 'required',
                    'email'                 => 'required|email|unique:registrations',
                    'asalSekolah'           => 'required',
                    'foto'                  => 'file|mimes:png,jpg,jpeg',
                    'swafoto'               => 'file|mimes:png,jpg,jpeg',
                    'pengalamanOrganisasi'  => 'required'
                ]
            ];
        } else {
            $rules = [
                'namaLengkap'           => 'required|regex:/^[\pL\s\-]+$/u',
                'tempatLahir'           => 'required',
                'tanggalLahir'          => 'required|before:today',
                'jenisKelamin'          => 'required',
                'nim'                   => 'required|numeric|digits_between:5,10',
                'programStudi'          => 'required',
                'semester'              => 'required|numeric',
                'tahunAngkatan'         => 'required',
                'noTelepon'             => 'required|digits_between:0,15',
                'mottoHidup'            => 'required',
                'motivasiBEM'           => 'required',
                'email'                 => 'required|email|unique:registrations',
                'asalSekolah'           => 'required',
                'foto'                  => 'required|file|mimes:png,jpg,jpeg',
                'swafoto'               => 'required|file|mimes:png,jpg,jpeg',
                'pengalamanOrganisasi'  => 'required'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'namaLengkap.required' => 'Nama Wajib Diisi',
            'namaLengkap.regex' => 'Nama Tidak Boleh Mengandung Angka / Simbol',
            'tempatLahir.required' => 'Tempat Lahir Wajib Diisi',
            'tanggalLahir.required' => 'Tanggal Lahir Wajib Diisi',
            'tanggalLahir.before' => 'Tanggal Lahir Tidak Valid',
            'jenisKelamin.required' => 'Jenis Kelamin Wajib Diisi',
            'nim.required' => 'NIM Wajib Diisi',
            'nim.numeric' => 'NIM Harus Berbentuk Angka',
            'nim.digits_between' => 'NIM Harus Sebanyak 5 sampai 10 digit',
            'programStudi.required' => 'Program Studi Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
            'semester.numeric' => 'Semester Harus Berbentuk Angka',
            'tahunAngkatan.required' => 'Tahun Angkatan Wajib Diisi',
            'noTelepon.required' => 'Nomor Telepon Wajib Diisi',
            'noTelepon.digits_between' => 'Nomor Telepon Maksimal 15 digit',
            'mottoHidup.required' => 'Motto Hidup Wajib Diisi',
            'motivasiBEM.required' => 'Motivasi Mengikuti BEM Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'asalSekolah.required' => 'Asal Sekolah Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'swafoto.required' => 'Swafoto Wajib Diisi',
            'pengalamanOrganisasi.required' => 'Pengalaman Organisasi Wajib Diisi',

            'foto.mimes' => 'Format Foto Wajib JPG, JPEG, Dan PNG',
            'swafoto.mimes' => 'Format Swafoto Wajib JPG, JPEG, Dan PNG',
        ];
    }
}
