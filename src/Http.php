<?php
namespace AzaelCodes\BookingComClient;

class Http
{
    /**
     * GET
     * @param $url
     * @param array $headers
     * @return array
     */
    public static function get($url, array $headers)
    {
        $curlOpts = [
            CURLOPT_URL => $url,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $curlOpts);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = [
            'code' => $httpCode,
            'response' => json_decode($response, true)
        ];
        return $result;
    }
}