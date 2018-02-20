<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $kirim = $client->get(env('API_URL').'/users/status/guru');
        return $kirim->getBody();
    }
    public function getsiswa()
    {
        $client = new Client();
        $kirim = $client->get(env('API_URL').'/users/status/siswa');
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
        $kirim = $client->post(env('API_URL').'/users',[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'name' => $request->nama,
                'email' => $request->email,
                'password'=>bcrypt($request->password),
                'status' => 'guru',
                'statusactive' => 'active',
                'nomortelpon' => $request->nomortelpon,
                'namasekolah' =>'SDN 07 Taman Kebalen',
                'kode_sekolah' =>'1'
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
        $kirim = $client->put(env('API_URL')."/".'users/'.$id,[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'name' => $request->nama,
                'email' => $request->email,
                'status' => 'guru',
                'statusactive' => 'active',
                'nomortelpon' => $request->nomortelpon,
                'namasekolah' =>'SDN 07 Taman Kebalen',
                'kode_sekolah' =>'1'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $client = new Client();
        $kirim = $client->put(env('API_URL')."/".'users/'.$id,[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'statusactive' => 'blocked',
            ]
        ]);
    }
    public function changestatus(Request $request){
        $client = new Client();
        $kirim = $client->put(env('API_URL')."/".'users/'.$request->id,[
            // 'headers' => [
            //         'Authorization' => 'Bearer ' . $token
            // ],
            'form_params' => [
                'statusactive' => $request->statusactive,
            ]
        ]);
    }
}
