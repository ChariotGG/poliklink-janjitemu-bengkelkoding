<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    private $views = 'Admin.';

    public function login()
    {
        return view($this->views."Auth.login");
    }

    public function logout()
    {
        session()->forget(['role','isLogin']);
        return redirect()->route('login.admin')->with('success','Berhasil Logout');
    }

    public function login_proses(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $admin = Admin::where('username', $request->username)->first();

    if (!$admin) {
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }

    if (!Hash::check($request->password, $admin->password)) {
        return redirect()->back()->with('error', 'Password salah');
    }

    session([
        'username' => $admin->username,
        'role' => $admin->role,
        'isLogin' => true,
    ]);

    return redirect()->route('dashboard')->with('success', 'Berhasil login');
}


    public function logut()
    {
        session()->flush();
        return redirect('/');
    }
    
    public function dashboard()
    {
        return view($this->views.'Dashboard.index');
    }

    public function poli()
    {
        return view($this->views."Poli.index",[
            'poli'  => Poli::get()
        ]);
    }

    public function poli_post(Request $request)
    {
        $data = $request->validate([
            'nama_poli'     => 'required',
            'keterangan'    => 'required'
        ],[
            'nama_poli.required'    => 'nama poli wajib diisi',
            'keterangan.required'   => 'keterangan poli wajib diisi'
        ]);
        

        try{
            Poli::create($data);
            return redirect()->back()->with('alert',[
                'type'  => 'success' , //error,warning,info
                'title' => 'Berhasil',
                'text'  => 'Berhasil menambahkan data poli'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'  => 'error' , //error,warning,info
                'title' => 'Gagal',
                'text'  => 'Gagal menambahkan data poli'
            ]);
        }
        // dd($data);
    }

    public function poli_edit($id)
    {
        return view($this->views.'Poli.edit',[
            'poli'  => Poli::where('id',$id)->first()
        ]);
    }

    public function poli_update(Request $request , $id)
    {
        $request->validate([
            'nama_poli'     => 'required',
            'keterangan'    => 'required'
        ]);
        try{
            $poli = Poli::where('id',$id)->first();
            $poli->update([
                'nama_poli'     => $request->nama_poli,
                'keterangan'    => $request->keterangan
            ]);

            return redirect()->route('poli')->with('alert',[
                'type'  => 'success',
                'title' => 'Berhasil',
                'text'  => 'Berhasil Edit Data'.$request->nama_poli
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'  => 'error',
                'title' => 'Gagal',
                'text'  => 'Terjadi Kesalahan'
            ]);
        }
    }

    public function poli_delete($id){
        $poli = Poli::where('id',$id)->first();
        $poli->delete();

        return redirect()->back()->with('alert',[
            'type'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'Berhasil Menghapus Data'
        ]);
    }

    public function dokter()
    {
        return view($this->views.'Dokter.index',[
            'dokter'    =>  Dokter::get(),
            'poli'      =>  Poli::get()
        ]);
    }

    public function dokter_post(Request $request)
    {
        $data = $request->validate([
            'nama_dokter'      => 'required',
            'alamat'           => 'required',
            'no_hp'            => 'required',
            'id_poli'          => 'required',
            'username'         => 'required'
        ],[
            'nama_dokter.required'  => 'nama dokter dokter harus diisi',
            'almat.required'    => 'alamat dokter harus diisi',
            'no_hp.required'    => 'nomor hp dokter wajib diisi',
            'id_poli'           => 'Poli harus diisi'
        ]);

       try{ 
            $password = Str::random(6);
            Dokter::create([
                'nama_dokter'      => $request->nama_dokter,
                'username'         => $request->username,
                'alamat'           => $request->alamat,
                'no_hp'            => $request->no_hp,
                'id_poli'          => $request->id_poli,
                'katasandi'        => $password,
                'password'         => Hash::make($password),
                'role'             => 'dokter'
            ]);
            return redirect()->back()->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Berhasil Menambahkan Data Dokter'
            ]);
       }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Gagal Menambahkan Data Dokter' . $e->getMessage()
            ]);
       }

    }

    public function dokter_edit($id)
    {
        return view($this->views.'Dokter.edit',[
            'dokter'    => Dokter::where('id',$id)->first(),
            'poli'      => Poli::get()
        ]);
    }

    public function dokter_update(Request $request,$id)
    {
        $request->validate([
            'nama_dokter'      => 'required',
            'alamat'           => 'required',
            'no_hp'            => 'required',
            'id_poli'          => 'required',
            'password'         => 'required'
        ]);

        try{
            $dokter = Dokter::where('id',$id)->first();
            $dokter->update([
                'nama_dokter'      => $request->nama_dokter,
                'alamat'           => $request->alamat,
                'no_hp'            => $request->no_hp,
                'id_poli'          => $request->id_poli,
                'katasandi'        => $request->password,
                'password'         => Hash::make($request->password),
                'role'             => 'dokter'
            ]);

            return redirect()->route('dokter')->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Berhasil Edit Data'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Gagal Edit Data'
            ]);
        }
    }

    public function dokter_delete($id)
    {
        $dokter = Dokter::where('id',$id)->first();
        $dokter->delete();

        return redirect()->back()->with('alert',[
            'type'  => 'success',
            'title' => 'Berhasil',
            'message'   => 'Berhasil menghapus data'
        ]);
    }

    public function obat()
    {
        return view($this->views."Obat.index",[
            'obat'  => Obat::get()
        ]);
    }

    public function obat_post(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required',
            'kemasan'   => 'required',
            'harga'     => 'required',
        ]);

        try{
            Obat::create($data);
            return redirect()->back()->with('alert',[
                'type'  => 'success',
                'title' => 'Berhasil',
                'message'   => 'Data Berhasil Ditambahkan'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type'  => 'error',
                'title' => 'Gagal',
                'message'   => 'Data Gagal Ditambahkan'
            ]);
        }
    }

    public function obat_edit($id)
    {
        return view($this->views."Obat.edit",[
            'obat'  => Obat::where('id',$id)->first()
        ]);
    }

    public function obat_update(Request $request,$id)
    {
        $data = $request->validate([
            'nama_obat' => 'required',
            'kemasan'   => 'required',
            'harga'     => 'required',
        ]);

        try{
            $obat = Obat::where('id',$id)->first();
            $obat->update($data);

            return redirect()->route('obat')->with('alert',[
                'type'      => 'success',
                'title'     => 'Berhasil',
                'message'   => 'Data Berhasil Di update'
            ]);
        }catch(\Exception $e){
            return redirect()->route('obat')->with('alert',[
                'type'      => 'error',
                'title'     => 'Gagal',
                'message'   => 'Data Gagal Di update'
            ]);
        }
    }

    public function obat_delete($id)
    {
        $obat = Obat::where('id',$id)->first();
        $obat->delete();

        return redirect()->back()->with('alert',[
            'type'      => 'success',
            'title'     => 'Berhasil',
            'message'   => 'Data Berhasil Dihapus'
        ]);
    }

    public function pasien()
    {
        return view($this->views."Pasien.index",[
            'pasien'    => Pasien::get(),
            'urutan'    => $this->semesta()
        ]);
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

    public function pasien_post(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required',
            'username'  => 'required',
            'alamat'    => 'required', 
            'no_ktp'    => 'required',
            'no_rm'     => 'required'
        ]);

        try{
            $data['role']      = 'pasien'; 
            $pswd              = Str::random(6);
            $data['password']  = Hash::make($pswd);
            $data['katasandi'] = $pswd;
            Pasien::create($data);

            return redirect()->back()->with('alert',[
                'type' => 'success',
                'title' => 'Berhasil',
                'message'   => 'Berhasil Menambahkan Data Pasien'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type' => 'error',
                'title' => 'Gagal',
                'message'   => 'Gagal Menambahkan Data Pasien'
            ]);
        }
    }

    public function pasien_edit($id)
    {
        return view($this->views."Pasien.edit",[
            'pasien'    => Pasien::where('id',$id)->first()
        ]);
    }

    public function pasien_update(Request $request,$id)
    {
        $data = $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required',
            'no_rm'     => 'required',
            'password'  => 'required'
        ]);
        try{
            $pasien               = Pasien::where('id',$id)->first();
            $data['password']     = Hash::make($request->password);
            $data['katasandi']    = $request->password;
            $data['role']         = 'pasien';
            $pasien->update($data);

            return redirect()->route('pasien')->with('alert',[
                'type' => 'success',
                'title' => 'Berhasil',
                'message'   => 'Berhasil Mengedit Data Pasien'
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('alert',[
                'type' => 'error',
                'title' => 'Gagal',
                'message'   => 'Gagal Mengedit Data Pasien'
            ]);
        }
    }

    public function pasien_delete($id)
    {
        $data = Pasien::where('id',$id)->first();
        $data->delete();

        return redirect()->back()->with('alert',[
            'type' => 'success',
            'title' => 'Berhasil',
            'message'   => 'Berhasil Menghapus Data Pasien'
        ]);
    }
}
