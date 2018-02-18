<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class siswa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $kirim = $client->get(env('API_URL').'/siswa');
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
        $kirim = $client->post(env('API_URL').'/siswa',[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'multipart' =>[
                [
                    'name' => 'nama',
                    'contents' => $request->nama
                ],
                [
                    'name' => 'email',
                    'contents'=>$request->email
                ],
                [
                    'name' => 'alamat',
                    'contents'=>$request->alamat
                ],
                [
                    'name'=> 'tempatlahir',
                    'contents'=>$request->tempatlahir
                ],
                [
                    'name' =>'foto',
                    'contents'=> fopen($request->pathfile,'r'),
                    'filename' =>$request->pathfile->getClientOriginalName()
                ],
                [
                    'name' => 'tanggallahir',
                    'contents' =>$request->tanggallahir
                ]
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
