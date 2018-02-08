<?php
namespace AzaelCodes\BookingComClient;
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
     * buildAuthCredentials
     *
     * set username and password that are found in
     * the config file.
     */
    public function buildAuthCredentials()
    {
        /*
         * Change to $this->getConfig() when ready for production.
         * You might also need to create a dev.php file in the config/
         * folder, this should be a copy of app.php but with your dev
         * environment
         */
        $this->config = $this->getDevConfig();
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
     * Booking.com uses Basic Authentication for their API access.
     * @return array
     */
    public function getHeaderWithBasicAuthentication()
    {
        $headers = [
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password),
            'cache-control: no-cache'
        ];
        return $headers;
    }

    /**
     * @param $request
     * @return bool
     */
    public function isResponseOK($request)
    {
        return $request['code'] == 200;
    }
}