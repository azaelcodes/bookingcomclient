<?php
namespace AzaelCodes\BookingComClient;

class Config
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return require 'config/app.php';
    }

    /**
     * @return mixed
     */
    public function getDevConfig()
    {
        return require 'config/dev.php';
    }
}