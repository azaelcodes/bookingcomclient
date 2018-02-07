<?php
namespace AzaelCodes\BookingComClient;

class Config
{
    public function getConfig()
    {
        return require 'config/app.php';
    }
}