<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array("" => "", "ip" => "0.0.0.0");
        $address_string = json_encode($data);

        $curl = curl_init('http://ipv4.webshare.io/');
        curl_setopt($curl, CURLOPT_PROXY, 'http://p.webshare.io:80');
        curl_setopt($curl, CURLOPT_PROXYUSERPWD, 'kmtczqss-rotate:itq5ib6iih2h');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $address_string);
        curl_exec($curl);
        curl_close($curl);


        $address = DB::table('ip_address')
            ->select(DB::raw('ip_address, count(ip_address) as count'))
            ->groupBy('ip_address')->get();

        //dd($address);

        return view('welcome', compact('address'));
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
    public function store(IpAddress $request)
    {
        $data = array_merge($request->all(), ['id' => $request->ip(), 'ip_address' => 'ip_address']);

        IpAddress::create($data);

        Session::flash('flash_message', "Adres ip zapisany!");

        return redirect('/');
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
