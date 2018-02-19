<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class guruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $kirim = $client->get(env('API_URL').'/guru');
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
        //  echo $request->file->getClientOriginalName();
          $kirim = $client->post(env('API_URL').'/guru',[
              // 'headers' => [
              //         'Authorization' => 'Bearer ' . $token
              // ],
              'multipart' =>[
                  [
                      'name' => 'namaguru',
                      'contents' => $request->nama
                  ],
                  [
                      'name' => 'nomortelpon',
                      'contents'=>$request->nomortelpon
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
                      'name'=> 'jeniskelamin',
                      'contents'=>$request->jeniskelamin
                  ],
                  [
                      'name' =>'foto',
                      'contents'=> fopen($request->file,'r'),
                      'filename' =>$request->file->getClientOriginalName()
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
        $client = new Client();
        $kirim = $client->delete(env('API_URL')."/"."guru/".$id);
    }
}
