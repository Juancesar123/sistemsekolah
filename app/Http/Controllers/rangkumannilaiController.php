<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class rangkumannilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $kirim = $client->get(env('API_URL').'/rangkumannilai');
        return $kirim->getBody();  
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
        $client = new Client();
        $kirim = $client->post(env('API_URL').'/rangkumannilai',[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'idsiswa' => $request->idsiswa,
                'tugas' => $request->tugas,
                'nilaiharian' => $request->harian,
                'ukk' => $request->ukk,
                'uts' => $request->uts,
                'totalnilai' => $request->totalnilai,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new Client();
        $kirim = $client->put(env('API_URL')."/"."rangkumannilai/".$id,[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'idsiswa' => $request->idsiswa,
                'tugas' => $request->tugas,
                'nilaiharian' => $request->harian,
                'ukk' => $request->ukk,
                'uts' => $request->uts,
                'totalnilai' => $request->totalnilai,
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $kirim = $client->delete(env('API_URL')."/"."rangkumannilai/".$id);
    }
}
