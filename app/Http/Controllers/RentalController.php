<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class RentalController extends Controller
{
    public function index()
    {
        $data = (new BaseApi)->index('/api/rentals');
        $rentals = $data->json();
        return view('rentals.index')->with('rentals' , $rentals['data']);
    }

    public function create()
    {
        return view('rentals.create');
    }

    public function store(Request $request)
    {
        $total_harga =  $request->waktu_jam * 150000;

        $payload = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'type' => $request->type,
            'waktu_jam' => $request->waktu_jam,
            'total_harga' => $total_harga,
            'jam_mulai' => $request->jam_mulai,
            'supir' => $request->supir,
           ];

           $baseApi = new BaseApi;
           $response = $baseApi->create('/api/rentals/store', $payload);
            if ($response->failed()) {
                $errors = $response->json('data');
                return redirect()->back()->with(['errors' => $errors]);
            }
    return redirect('/rentals')->with('success', 'Success add new Rentals to API!');

    }

    // public function show($id)
    // {
    //     $data = (new BaseApi)->detail('/api/students', $id);
    //     $students = $data->json();
    //     return view('students.show')->with('students' , $students['data']);
    // }

    public function edit($id)
    {
        $data = (new BaseApi)->detail('/api/rentals', $id);
        $rentals = $data->json();
        return view('rentals.update')->with('rentals' , $rentals['data']);
    }

    public function update(Request $request, $id)
    {
        $data = (new BaseApi)->detail('/api/rentals', $id);
        $rentals = $data->json('data');
        $riwayat = 'Dimulai pada jam ' . $rentals['jam_mulai'] . ' dengan titik penjemputan di ' . $rentals['alamat'] . ' Dan selesai pada jam ' . $request->jam_selesai . ' dengan titik akhir di ' . $request->tempat_tujuan;
        $payload = [
            'jam_selesai' => $request->jam_selesai,
            'tempat_tujuan' => $request->tempat_tujuan,
            'status' => 'selesai',
            'riwayat_perjalanan' => $riwayat,
           ];

           $baseApi = new BaseApi;
           $response = $baseApi->update('/api/rentals/update',$id, $payload);
            if ($response->failed()) {
                $errors = $response->json('data');
                return redirect()->back()->with(['errors' => $errors]);
            }

    return redirect('/rentals')->with('success', 'Success updated rentals to API!');


    //     $payload = [
    //         'nis' => $request->nis,
    //         'nama' => $request->nama,
    //         'rombel' => $request->rombel,
    //         'rayon' => $request->rayon,
    //         'tgl_lahir' => $request->tgl_lahir,
    //        ];

    //        $baseApi = new BaseApi;
    //        $response = $baseApi->update('/api/students/update', $id, $payload);
    //         if ($response->failed()) {
    //             $errors = $response->json('data');
    //             return redirect()->back()->with(['errors' => $errors]);
    //         }

    // return redirect('/siswa')->with('success', 'Success updated API!');
    }

    public function destroy(Request $request, $id)
    {
        $baseApi = new BaseApi;
        $response = $baseApi->delete('/api/rentals/delete', $id);
        return redirect('rentals');



        // $baseApi = new BaseApi;
        // $data = $baseApi->delete('/api/students/delete', $id);
        // if ($data->failed()) {
        //     return redirect('/siswa')->with('fail', 'Data cant deleted from the API');
        // }

        // return redirect('/siswa')->with('success', 'Data was deleted from the API');
    }
}
