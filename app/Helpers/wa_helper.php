<?php

if (!function_exists('kirimWa')) {
    function kirimWa($noHp, $pesan)
    {
        $token = 'ISI_TOKEN_WABLAS_ANDA'; // ganti dengan token dari wablas
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://console.wablas.com/api/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'phone' => $noHp,
                'message' => $pesan,
                'secret' => false,
                'priority' => false,
                'retry' => false,
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
