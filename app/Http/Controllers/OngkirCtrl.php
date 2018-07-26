<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OngkirCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function curl_get_content($url, $method = '', $postdata = '') {
        $curl = curl_init();
        if ($method == 'POST') {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: your-api-key"
                ),
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: your-api-key"
                ),
            ));
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function index()
    {
        $data = $this->curl_get_content('https://api.rajaongkir.com/starter/province');
        $data = json_decode($data, true);
        $this->data['province'] = $data['rajaongkir']['results'];
        $this->data['title'] = "Raja Ongkir";
        return view('ongkir.index', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getProvince() {
        $data = $this->curl_get_content('https://api.rajaongkir.com/starter/province');
        $data = json_decode($data, true);
        $this->data['province'] = $data['rajaongkir']['results'];
        $content = view('ongkir.prov', $this->data)->render();
        return $content;
    }

    public function getKota(Request $request) {
        // echo "test";exit;
        // echo json_encode($request->all());exit;
        $prov_id = $request->prov_id;
        $data = $this->curl_get_content('https://api.rajaongkir.com/starter/city?&province=' . $prov_id);
        $city = json_decode($data, true);
        $this->data['city'] = $city['rajaongkir']['results'];
        return view('ongkir.kab', $this->data);
    }

    public function getTarif(Request $request) {

        $input = '';
        $input = "origin=".$request->asal."&destination=".$request->kab_id."&weight=".$request->berat."&courier=".$request->kurir;
        $data = $this->curl_get_content('https://api.rajaongkir.com/starter/cost', 'POST', $input);
        $data = json_decode($data, true);
        // echo $data;
        if ($data['rajaongkir']['status']['code'] == '200') {
            $this->data['destination'] = $data['rajaongkir']['destination_details'];
            $this->data['tariff'] = $data['rajaongkir']['results'];
        }
        return view('ongkir.tarif', $this->data);
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
        //
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
