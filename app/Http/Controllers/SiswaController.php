<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datasiswa;
use App\kelas;
use App\jadwal_piket;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_student = datasiswa::with('piket')->with('showclass')->get();
        $data_class = kelas::all();
        $data_picket = jadwal_piket::all();

        // dd($data_class);
        $selectclass = [''=>'Pilih Kelas'];

        foreach ($data_class as $item) {
            $selectclass[$item->id] = $item->nama_kelas;
        }

        $selectpicket = [''=>'Pilih Piket'];

        foreach ($data_picket as $item) {
            $selectpicket[$item->id] = $item->hari;
        }

        return view('siswa.siswa',compact('data_student','selectclass','selectpicket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_nisn = datasiswa::where('NISN', $request->NISN)->doesntExist();
        $check_kelas_and_absen = datasiswa::where('id_kelas', $request->id_kelas)->where('absen', $request->absen)->doesntExist();


        if($check_nisn && $check_kelas_and_absen){
            $insert = new datasiswa();
            $insert->id_kelas = $request->id_kelas;
            $insert->id_piket = $request->piket;
            $insert->NISN = $request->NISN;
            $insert->nama = $request->nama;
            $insert->jenis_kelamin = $request->jk;
            $insert->absen = $request->absen;
            $insert->save();

            return redirect('siswa')->with('alert_success', 'Berhasil! Data Berhasil Ditambahkan');
        } else {
            return redirect('siswa')->with('alert_fail', 'Gagal! Data gagal Ditambahkan');
        }
        

        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $update = datasiswa::find($id);
        $update->id_kelas = $request->id_kelas;
        $update->id_piket = $request->piket;
        $update->nama = $request->nama;
        $update->jenis_kelamin = $request->jk;
        $update->absen = $request->absen;
        $update->save();
        if ($update) {
        return redirect('siswa')->with('alert_success', 'Berhasil! Data Berhasil DiUbah');
        } else {
            return redirect('siswa')->with('alert_fail', 'Gagal! Data gagal Diubah');
        }
    }


    public function destroy($id)
    {
        $delete = datasiswa::destroy($id);
        if ($delete) {
            return redirect('siswa')->with('alert_success', 'Berhasil! Data Berhasil DiHapus');
        } else {
            return redirect('siswa')->with('alert_fail', 'Gagal! Data gagal DiHapus');
        }
    }
}
