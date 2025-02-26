<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    private $views = 'Dokter.';
    public function index()
    {
        $konsultasi = Konsultasi::all();
        return view('konsultasi.index', compact('konsultasi'));
    }

    public function login()
    {
        return view($this->views . "Auth.login");
    }

    public function logout()
    {
        session()->forget(['role', 'isLogin']);
        return redirect('/')->with('success', 'Berhasil Logout');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $anonim = Dokter::where('username', $request->username)->first();
        if ($anonim == NULL) {
            return redirect()->back()->with('error', 'Data dokter tidak ditemukan');
        }

        if (Hash::check($request->password, $anonim->password) == FALSE) {
            return redirect()->back()->with('error', 'Password Salah');
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

        return redirect()->route('dokter.dashboard')->with('success', 'berhasil login');
    }

    public function dashboard()
    {
        return view($this->views . "Dashboard.index");
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

        try {
            $data['status'] = 1;
            JadwalPeriksa::create($data);

            return redirect()->back()->with('alert', [
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Berhasil menambahkan jadwal'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Gagal menambahkan jadwal'
            ]);
        }
    }

    public function jadwal_periksa_edit($id)
    {
        return view($this->views . "Jadwalperiksa.edit", [
            'jadwal'    => JadwalPeriksa::where('id', $id)->first()
        ]);
    }

    public function jadwal_periksa_update(Request $request, $id)
    {
        $data = $request->validate([
            'id_dokter'     => 'required',
            'hari'          => 'required',
            'jam_selesai'   => 'required',
            'jam_mulai'     => 'required',
            'status'        => 'required'
        ]);

        try {
            $jadwal = JadwalPeriksa::where('id', $id)->first();
            $jadwal->update($data);

            return redirect()->route('dokter.jadwal-periksa')->with('alert', [
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Jadwal Berhasil Diupdate'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Jadwal Gagal Diupdate'
            ]);
        }
    }

    public function jadwal_periksa_delete($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)->first();
        $jadwal->delete();

        return redirect()->back()->with('alert', [
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

        $sudah_periksa = Periksa::get();

        return view($this->views . 'Periksapasien.index', [
            'pasien_periksa' => $pasien_periksa,
            'sudah_periksa' => $sudah_periksa
        ]);
    }

    public function periksa_pasien_edit(Request $request, $id)
    {
        $daftarpoli = DaftarPoli::findOrFail($id);
        $obat = Obat::all();
        return view($this->views . 'Periksapasien.edit', compact('daftarpoli', 'obat'));
    }

    public function periksa_pasien_post(Request $request)
    {
        $data_periksa = [
            'id_daftar_poli'    => $request->id_daftar_poli,
            'tanggal_periksa'   => $request->tgl_periksa,
            'catatan'           => $request->catatan,
            'biaya_periksa'     => $request->biaya_periksa
        ];

        $periksa = Periksa::create($data_periksa);

        if (is_array($request->obat_ids)) {
            foreach ($request->obat_ids as $obat_id) {

                $data_detail = [
                    'id_periksa' => $periksa->id,
                    'id_obat'    => $obat_id
                ];

                DetailPeriksa::create($data_detail);
            }
        } else {

            $data_detail = [
                'id_periksa' => $periksa->id,
                'id_obat'    => $request->obat_ids
            ];

            DetailPeriksa::create($data_detail);
        }

        return redirect('dokter/periksa-pasien')->with('alert', [
            'type'      => 'success',
            'title'     => 'Berhasil',
            'message'   => 'Berhasil memeriksa'
        ]);
    }

    public function periksa_pasien_periksa(Request $request)
    {
        return view($this->views . 'Periksapasien.periksa');
    }

    public function riwayat_pasien()
    {
        $dokter = session()->get('id');
        $jadwal_periksa = JadwalPeriksa::where('id_dokter', $dokter)->first();
        $pasien_periksa = DaftarPoli::where('id_jadwal', $jadwal_periksa->id)->get();
        $riwayat = Periksa::get();
        return view($this->views . 'Riwayatpasien.index', [
            'riwayat'   => $riwayat
        ]);
    }

    public function riwayat_pasien_show($id)
    {
        $riwayat = Periksa::where('id', $id)->first();
        $obat = DetailPeriksa::get();

        return view($this->views . 'Riwayatpasien.show', [
            'riwayat'   => $riwayat,
            'obat'      => $obat
        ]);
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

        try {
            $dokter = Dokter::where('id', $request->id)->first();
            $dokter->update($data);

            // Update session cuy
            $session = [
                'nama_dokter'   => $request->nama_dokter,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
            ];

            session($session);

            return redirect()->route('dokter.profile')->with('alert', [
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Profile Dokter Berhasil Diupdate'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Profile Dokter Gagal Diupdate'
            ]);
        }
        return view($this->views . 'Profile.index');
    }
    public function konsultasiIndex()
    {
        $konsultasi = Konsultasi::where('id_dokter', session()->get('id'))->get();
        return view('dokter.konsultasi.index', compact('konsultasi'));
    }

    public function konsultasiTanggapi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('dokter.konsultasi.jawab', compact('konsultasi'));
    }

    public function konsultasiEdit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('dokter.konsultasi.edit', compact('konsultasi'));
    }

    public function konsultasiUpdate(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('dokter.konsultasi.index')->with('success', 'Konsultasi berhasil diperbarui.');
    }
}
