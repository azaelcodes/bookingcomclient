<?php
require '../vendor/autoload.php';
$hotel = new \AzaelCodes\BookingComClient\Hotel();
print_r($hotel->getHotelByDestinationId('20088325', 1));
