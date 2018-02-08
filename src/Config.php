<?php
namespace AzaelCodes\BookingComClient;

class Config
{
    public function getConfig()
    {
        return require 'config/dev.php';
    }
}