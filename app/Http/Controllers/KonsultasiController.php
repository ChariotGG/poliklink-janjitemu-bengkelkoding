<?php
// app/Http/Controllers/KonsultasiController.php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::all();
        return view('konsultasi.index', compact('konsultasi'));
    }

    public function create()
    {
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        return view('konsultasi.create', compact('pasien', 'dokter'));
    }

    public function store(Request $request)
    {
        $konsultasi = new Konsultasi();
        $konsultasi->subject = $request->input('subject');
        $konsultasi->pertanyaan = $request->input('pertanyaan');
        $konsultasi->id_pasien = $request->input('id_pasien');
        $konsultasi->id_dokter = $request->input('id_dokter');
        $konsultasi->save();
        return redirect()->route('konsultasi.index');
    }

    public function edit($id)
    {
        $konsultasi = Konsultasi::find($id);
        return view('konsultasi.edit', compact('konsultasi'));
    }

    public function update(Request $request, $id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->subject = $request->input('subject');
        $konsultasi->pertanyaan = $request->input('pertanyaan');
        $konsultasi->save();
        return redirect()->route('konsultasi.index');
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->delete();
        return redirect()->route('konsultasi.index');
    }

    public function jawab($id)
    {
        $konsultasi = Konsultasi::find($id);
        return view('konsultasi.jawab', compact('konsultasi'));
    }

    public function updateJawaban(Request $request, $id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->jawaban = $request->input('jawaban');
        $konsultasi->save();
        return redirect()->route('konsultasi.index');
    }
}
