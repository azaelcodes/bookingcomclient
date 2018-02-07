<?php
namespace AzaelCodes\BookingComClient;
use AzaelCodes\BookingComClient\Http as Http;

class Client extends Config
{
    private $username;
    private $password;
    private $apiUrl;
    private $config;

    const API_URL       = 'https://distribution-xml.booking.com/';
    const API_VERSION   = '2.0';
    const JSON_CONTENT  = 'json';

    public function __construct()
    {
        $this->buildAuthCredentials();
        $this->buildBookingApiUrl();
    }

    /**
     * Set the API credentials, obtained from the Config files.
     */
    public function buildAuthCredentials()
    {
        // Read from a config file
        $this->config = $this->getConfig();
        $this->username = $this->config['username'];
        $this->password = $this->config['password'];
    }

    /**
     * Build the Booking.com Api URL
     */
    public function buildBookingApiUrl()
    {
        $this->apiUrl = static::API_URL . static::API_VERSION . '/' . static::JSON_CONTENT;
    }

    /**
     * @return mixed
     */
    public function getBookingApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param array $requestedInfo
     * @return array
     */
    public function getHotelData(array $requestedInfo)
    {
        $headers = [
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password),
            'cache-control: no-cache'
        ];
        $url = $this->getBookingApiUrl() . '/hotels?' . http_build_query($requestedInfo);
        $request = Http::get($url, $headers);
        $data = $request['code'] == 200 ? $request['response']['result'] : null;
        return $data;
    }
}