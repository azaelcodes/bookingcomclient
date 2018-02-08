<?php
namespace AzaelCodes\BookingComClient;
/**
 * Hotel Related Information:
 *
 * List of additional data that can be requested (To be added a comma separated values)
 * (see $requestData['extras']).
 * hotel_info
 * hotel_photos
 * hotel_description
 * hotel_facilities
 * hotel_policies
 * payment_details
 * room_info
 * room_photos
 * room_description
 * room_facilities
 *
 *
 * Class Hotel
 * @package AzaelCodes\BookingComClient
 */
class Hotel extends Client
{
    /**
     * Get Hotel Information by destination ID.
     *
     * Example Destination Id: 20088325 (New York City)
     *
     * @param $destinationId
     * @param $count
     * @return array | json
     */
    public function getHotelByDestinationId($destinationId, $count)
    {
        $requestData = [
            'city_ids' => $destinationId,
            'rows' => $count,
            'extras' => 'hotel_info, hotel_description'
        ];
        $url = $this->getBookingApiUrl() . '/hotels?' . http_build_query($requestData);
        $request = Http::get($url, $this->getHeaderWithBasicAuthentication());
        if (!$this->isResponseOK($request)) {
            return [];
        }
        return json_encode($request['response']['result'], JSON_PRETTY_PRINT);
    }
}