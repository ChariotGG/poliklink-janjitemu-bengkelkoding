<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\Konsultasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    private $views = 'Pasien.';
    public function login()
    {
        return view($this->views . "Auth.login");
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $anonim = Pasien::where('username', $request->username)->first();
        if ($anonim == NULL) {
            return redirect()->back()->with('error', 'Data Pasien Tidak Ditemukan');
        }

        if (Hash::check($request->password, $anonim->password) == FALSE) {
            return redirect()->back()->with('error', 'Password Salah');
        }

        $session = [
            'id'        => $anonim->id,
            'nama'      => $anonim->nama,
            'role'      => $anonim->role,
            'alamat'    => $anonim->alamat,
            'no_ktp'    => $anonim->no_ktp,
            'no_rm'     => $anonim->no_rm,
            'isLogin'   => TRUE
        ];

        session($session);
        return redirect()->route('pasien.dashboard')->with('success', 'Berhasil Login');
    }

    private function semesta()
    {
        $hariini        = Carbon::today();
        $pasien_hariini = Pasien::whereDate('created_at', $hariini)->count();
        $urutan_pasien  = $pasien_hariini + 1;
        $tahun_bulan    = $hariini->format('Ym');
        $urutan_pasien  = $tahun_bulan . '-' . str_pad($urutan_pasien, 2, '0', STR_PAD_LEFT);

        return $urutan_pasien;
    }

    public function register()
    {
        return view($this->views . "Auth.register", [
            'urutan'    => $this->semesta()
        ]);
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'username'  => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required',
            'no_rm'     => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'nama'      => $request->nama,
            'username'  => $request->username,
            'alamat'    => $request->alamat,
            'no_ktp'    => $request->no_ktp,
            'no_rm'     => $request->no_rm,
            'password'  => Hash::make($request->password),
            'katasandi' => $request->password,
            'role'      => 'pasien'
        ];

        Pasien::create($data);

        return redirect()->route('login.pasien')->with('success', 'Berhasil Mendaftar');
    }

    public function logout()
    {
        session()->forget(['role', 'isLogin']);
        return redirect()->route('login.pasien')->with('success', 'Berhasil Logout');
    }

    public function dashboard()
    {
        return view($this->views . "Dashboard.index");
    }

    public function poli()
    {
        return view($this->views . "Poli.index", [
            'poli'      => Poli::get(),
        ]);
    }

    public function poli_id_poli($id)
    {
        $poli       = Poli::where('id', $id)->first();
        $dokters    = Dokter::where('id_poli', $poli->id)->get();
        $jadwals    = JadwalPeriksa::with('dokter')->whereIn('id_dokter', $dokters->pluck('id'))->get();

        return view($this->views . "Poli.show", [
            'jadwals'   => $jadwals,
            'poli'      => $poli,
            'pasien'    => session()->get('no_rm'),
            'pasien_id' => session()->get('id')
        ]);
    }

    public function riwayat_poli()
    {
        $session = session()->get('id');

        $daftar_poli = DaftarPoli::where('id_pasien', $session)->get();

        $periksa = Periksa::all();

        foreach ($daftar_poli as $daftar) {
            $pemeriksaan = $periksa->where('id_daftar_poli', $daftar->id)->first();

            if ($pemeriksaan) {
                $daftar->status_periksa = 'Sudah Diperiksa';
            } else {
                $daftar->status_periksa = 'Belum Diperiksa';
            }
        }

        $pasien = Pasien::where('id', $session)->first();

        return view($this->views . "Poli.riwayat", [
            'daftar_poli' => $daftar_poli,
            'pasien' => $pasien
        ]);
    }

    public function poli_daftar(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'id_pasien'     => 'required',
            'id_jadwal'     => 'required',
            'keluhan'       => 'required',
            'no_antrian'    => 'required'
        ]);

        try {
            DaftarPoli::create($data);

            return redirect()->route('pasien.poli.riwayat')->with('alert', [
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Berhasil Mendaftar'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type'     => 'error',
                'title'     => 'Gagal',
                'message'   => 'Gagal Mendaftar'
            ]);
        }
    }

    public function riwayat_poli_detail($id)
    {
        $daftarpoli = DaftarPoli::where('id', $id)->first();
        if (!$daftarpoli) {
            return redirect()->route('pasien.riwayat-poli')->with('alert', [
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Data tidak ditemukan.'
            ]);
        }
        $periksa    = Periksa::where('id_daftar_poli', $id)->first();
        $status     = $periksa ? 'Sudah Diperiksa' : 'Belum Diperiksa';
        $jadwal     = $daftarpoli->jadwalPeriksa;
        $dokter     = $jadwal ? $jadwal->dokter : null;
        $poli       = $jadwal ? $jadwal->poli : null;
        return view($this->views . "Poli.riwayat-detail", [
            'daftarpoli'    => $daftarpoli,
            'periksa'       => $periksa,
            'status'        => $status,
            'dokter'        => $dokter,
            'poli'          => $poli,
            'jadwal'        => $jadwal
        ]);
    }

    public function konsultasiIndex()
    {
        $konsultasi = Konsultasi::where('id_pasien', session()->get('id'))->get();
        return view('pasien.konsultasi.index', compact('konsultasi'));
    }

    public function konsultasiCreate()
    {
        $dokter = Dokter::all();
        return view('pasien.konsultasi.create', compact('dokter'));
    }


    public function konsultasiStore(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'subject' => 'required|string|max:255',
            'pertanyaan' => 'required|string',
        ]);

        Konsultasi::create([
            'subject' => $request->subject,
            'pertanyaan' => $request->pertanyaan,
            'tgl_konsultasi' => now(),
            'id_pasien' => session()->get('id'),
            'id_dokter' => $request->id_dokter,
        ]);

        return redirect()->route('pasien.konsultasi.index')->with('success', 'Pertanyaan berhasil dikirim.');
    }
    public function konsultasiEdit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        // Pastikan hanya pasien yang membuat konsultasi bisa mengeditnya
        if ($konsultasi->id_pasien != session()->get('id')) {
            abort(403, 'Unauthorized action.');
        }

        $dokter = Dokter::all(); // List dokter untuk dropdown
        return view('pasien.konsultasi.edit', compact('konsultasi', 'dokter'));
    }

    public function konsultasiUpdate(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        // Pastikan hanya pasien yang membuat konsultasi bisa mengeditnya
        if ($konsultasi->id_pasien != session()->get('id')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'subject' => 'required|string|max:255',
            'pertanyaan' => 'required|string',
        ]);

        $konsultasi->update([
            'subject' => $request->subject,
            'pertanyaan' => $request->pertanyaan,
        ]);

        return redirect()->route('pasien.konsultasi.index')->with('success', 'Pertanyaan berhasil diperbarui.');
    }
    public function konsultasiDestroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        // Pastikan hanya pasien yang membuat konsultasi bisa menghapusnya
        if ($konsultasi->id_pasien != session()->get('id')) {
            abort(403, 'Unauthorized action.');
        }

        $konsultasi->delete();

        return redirect()->route('pasien.konsultasi.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
