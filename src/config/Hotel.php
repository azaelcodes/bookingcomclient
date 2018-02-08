<?php
namespace AzaelCodes\BookingComClient;

class Hotel extends Client
{
    /**
     * Get Hotel Information by destination ID.
     *
     * Example Destination Id: 20088325 (New York City)
     *
     * @param $destinationId
     * @param $count
     * @return null
     */
    public function getHotelByDestinationId($destinationId, $count)
    {
        $requestData = [
            'city_ids' => $destinationId,
            'rows' => $count,
            'extras' => implode(',', $this->getAvailableHotelInfo())
        ];
        $url = $this->getBookingApiUrl() . '/hotels?' . http_build_query($requestData);
        $request = Http::get($url, $this->getHeaderWithBasicAuthentication());
        if (!$this->isResponseOK($request)) {
            return [];
        }
        return $request['response']['result'];
    }

    /**
     * @return array
     */
    public function getAvailableHotelInfo(){
        return [
            'hotel_info',
            'hotel_photos',
            'hotel_description',
            'hotel_facilities',
            'hotel_policies',
            'payment_details',
            'room_info',
            'room_photos',
            'room_description',
            'room_facilities'
        ];
    }
}