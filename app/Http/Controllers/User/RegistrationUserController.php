<?php

namespace App\Http\Controllers\User;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use App\Models\RegistrationSetting;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Controllers\Controller;

class RegistrationUserController extends Controller
{
    public function index()
    {
        $registrationSetting = RegistrationSetting::first();
        $globalSetting = GlobalSetting::first();

        return view('pages.user.pendaftaran.index', [
            'registrationSetting' => $registrationSetting,
            'globalSetting'   => $globalSetting
        ]);
    }

    public function store(RegistrationRequest $request)
    {
        $data = $request->all();
        $data['foto'] = $request->file('foto')->store('pendaftaran/foto', 'public');
        $data['swafoto'] = $request->file('swafoto')->store('pendaftaran/swafoto', 'public');

        Registration::create($data);

        return redirect()->route('pendaftaran-anggota')->with('success', 'Pendaftaran Calon Anggota BEM Berhasil Di Simpan');
    }
}
