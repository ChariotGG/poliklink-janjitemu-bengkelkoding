<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    private $views = 'Dokter.';

    public function login()
    {
        return view($this->views."Auth.login");
    }

    public function logout()
    {
        session()->forget(['role','isLogin']);
        return redirect('/')->with('success','Berhasil Logout');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);    

        $anonim = Dokter::where('username',$request->username)->first();
        if($anonim == NULL){
            return redirect()->back()->with('error','Data dokter tidak ditemukan');
        }

        if(Hash::check($request->password,$anonim->password) == FALSE){
            return redirect()->back()->with('error','Password Salah');
        }

        $session = [
            'id'            => $anonim->id,
            'nama_dokter'   => $anonim->nama_dokter,
            'role'          => $anonim->role,
            'alamat'        => $anonim->alamat,
            'no_hp'         => $anonim->no_hp,
            'id_poli'       => $anonim->id_poli,
            'isLogin'       => TRUE
        ];
        
        session($session);

        return redirect()->route('dokter.dashboard')->with('success','berhasil login');
    }

    public function dashboard()
    {
        return view($this->views."Dashboard.index");
    }

    public function jadwal_periksa()
    {
        $jadwal = JadwalPeriksa::get();
    
        return view($this->views . "Jadwalperiksa.index", [
            'jadwal' => $jadwal
        ]);
    }

    public function jadwal_periksa_post(Request $request)
    {
        $data = $request->validate([
            'id_dokter'     => 'required',
            'hari'          => 'required',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required'
        ]);

        $jadwal = JadwalPeriksa::where('id_dokter', session()->get('id'))
        ->where('hari', $request->hari)
        ->first();

        if ($jadwal) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'title' => 'Gagal, Anda sudah memiliki jadwal periksa pada hari ini',
                'message' => 'Anda sudah memiliki jadwal periksa pada hari ini',
            ]);
        }

        try{
            $data['status'] = 1;
            JadwalPeriksa::create($data);

            return redirect()->back()->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Berhasil menambahkan jadwal'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Gagal menambahkan jadwal'
            ]);
        }
    }

    public function jadwal_periksa_edit($id)
    {
        return view($this->views."Jadwalperiksa.edit",[
            'jadwal'    => JadwalPeriksa::where('id',$id)->first()
        ]);
    }

    public function jadwal_periksa_update(Request $request,$id)
    {
        $data = $request->validate([
            'id_dokter'     => 'required',
            'hari'          => 'required',
            'jam_selesai'   => 'required',
            'jam_mulai'     => 'required',
            'status'        => 'required'
        ]);

        try{
            $jadwal = JadwalPeriksa::where('id',$id)->first();
            $jadwal->update($data);

            return redirect()->route('dokter.jadwal-periksa')->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Jadwal Berhasil Diupdate'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Jadwal Gagal Diupdate'
            ]);
        }
    }

    public function jadwal_periksa_delete($id)
    {
        $jadwal = JadwalPeriksa::where('id',$id)->first();
        $jadwal->delete();

        return redirect()->back()->with('alert',[
            'type'      => 'success',
            'title'     => 'Berhasil',
            'message'   => 'Data Berhasil Dihapus'
        ]);
    }

    public function periksa_pasien_index()
    {
        $dokter = session()->get('id'); 
        $jadwal_periksa = JadwalPeriksa::where('id_dokter', $dokter)->first(); 
        $pasien_periksa = DaftarPoli::where('id_jadwal', $jadwal_periksa->id)->get();
    
        return view($this->views.'Periksapasien.index', [
            'pasien_periksa' => $pasien_periksa,
        ]);
    }

    public function periksa_pasien_edit(Request $request,$id)
    {
        $daftarpoli = DaftarPoli::findOrFail($id);
        $obat = Obat::all();
        return view($this->views.'Periksapasien.edit', compact('daftarpoli', 'obat'));
    }

    public function periksa_pasien_post(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $data = $request->validate([
            'keluhan' => 'required|string',
            'obat_ids' => 'required|array|min:1',
            'obat_ids.*' => 'exists:obats,id',  // Validasi obat jika ada
        ]);
    
        try {
            // Ambil data pasien berdasarkan ID
            $daftarpoli = DaftarPoli::findOrFail($id);
    
            // Simpan riwayat pemeriksaan
            $periksa = new Periksa();
            $periksa->id_pasien = $daftarpoli->id_pasien; // Asumsi ada relasi pasien di DaftarPoli
            $periksa->id_dokter = session()->get('id'); // Ambil ID dokter dari session
            $periksa->keluhan = $data['keluhan'];
            $periksa->save(); // Simpan data pemeriksaan
            
            // Jika ada obat yang diberikan, simpan ke detail pemeriksaan
            if (isset($data['obat'])) {
                foreach ($data['obat'] as $obat_id) {
                    $detailPeriksa = new DetailPeriksa();
                    $detailPeriksa->id_periksa = $periksa->id;
                    $detailPeriksa->id_obat = $obat_id;
                    $detailPeriksa->save();
                }
            }
    
            // Update status pasien di DaftarPoli jika perlu
            $daftarpoli->status = 'sudah diperiksa';
            $daftarpoli->save();
    
            return redirect()->route('dokter.periksa-pasien.index')->with('alert', [
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Pemeriksaan pasien berhasil dilakukan'
            ]);
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return redirect()->back()->with('alert', [
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Pemeriksaan pasien gagal dilakukan'
            ]);
        }
    }
    

    public function periksa_pasien_periksa(Request $request)
    {
        return view($this->views . 'Periksapasien.periksa');
    }

    public function riwayat_pasien()
    {
        return view($this->views . 'Riwayatpasien.index');
    }

    public function profile()
    {
        return view($this->views . 'Profile.index');
    }

    public function profile_update(Request $request)
    {
        // dd($request->id);

        $data = [
            'nama_dokter'   => $request->nama_dokter,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
        ];

        try{
            $dokter = Dokter::where('id',$request->id)->first();
            $dokter->update($data);

            // Update session cuy
            $session = [
                'nama_dokter'   => $request->nama_dokter,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
            ];
            
            session($session);

            return redirect()->route('dokter.profile')->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Profile Dokter Berhasil Diupdate'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Profile Dokter Gagal Diupdate'
            ]);
        }
        return view($this->views . 'Profile.index');
    }
}
