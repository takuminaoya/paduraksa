<?php

namespace App\Modules;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Whapify
{

    public function __construct() {}
    /**
     * Get All Whapify Account
     * 
     * @param limit = limit per page
     * @param page = current page
     * 
     * @return object
     */
    public static function getAccounts($limit = 10, $page = 1)
    {
        $client = new Client();

        $response = $client->get(config('whapify.base_url') . 'get/wa.accounts?secret=' . config('whapify.secret') . '&limit=' . $limit . '&page=' . $page);
        $body = json_decode($response->getBody(), true);

        return collect($body['data']);
    }

    /**
     * Send a single chat to a number
     * 
     * @param recipient = number phone of recipient (6285356789333)
     * @param message = your message
     * @param type = text, media, or document default text
     * 
     * @return object
     */
    public static function sendSingleChat($recipient, $message, $type = null)
    {
        $client = new Client();

        $params = [];
        $params['form_params'] = [
            "secret" => config('whapify.secret'),
            "account" => config('whapify.account'),
            "recipient" => $recipient,
            "type" => $type ?? config('whapify.type'),
            "message" => $message
        ];

        $response = $client->post(config('whapify.base_url') . 'send/whatsapp', $params);
        $body = json_decode($response->getBody(), true);

        return collect($body['data']);
    }

    /**
     * Get a single chat to a number
     * 
     * @param id = whapify messageId
     * @param type = sent or recieved default sent
     * 
     * @return object
     */
    public static function getSingleChat($id, $type = 'sent')
    {
        $client = new Client();

        $response = $client->get(config('whapify.base_url') . 'get/wa.message?secret=' . config('whapify.secret') . '&type=' . $type . '&id=' . $id);
        $body = json_decode($response->getBody(), true);

        return collect($body['data']);
    }
}
