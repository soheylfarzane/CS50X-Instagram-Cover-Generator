<?php

namespace App\Http\Lib;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class Telegram
{
    protected $token;
    protected $botName;
    protected $botId;
    protected $forwardPath;
    protected $copyMessage;
    protected $baseUrl;
    protected $chatId;
    protected $sendPath;
    protected $sendPhotoPath;
    protected $sendDocument;
    protected $sendLocationPath;

    public function __construct()
    {
        $this->botName = env('BOT_NAME2');
        $this->botId = env('BOT_ID2');
        $this->chatId = env('CHAT_ID2');
        $this->baseUrl = 'https://api.telegram.org/bot'.$this->token = env('BOT_TOKEN2');
        $this->sendPath = '/sendMessage';
        $this->forwardPath = '/forwardMessage';
        $this->copyMessage = '/copyMessage';
        $this->sendLocationPath = '/sendLocation';
        $this->sendPhotoPath = '/sendPhoto';
        $this->sendDocument = '/sendDocument';

    }

    private function curl($parameter,$val)
    {
        $token = env('BOT_TOKEN2');
        $url = $this->baseUrl.$token.$parameter;
        $client = new Client([ 'verify' => false ]);
        $response = $client->post($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>
                $val
            ]);
        return $response;
    }
    public function get()
    {
        $parameter = '/getMe';
        $val = [];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
          return $obj;

}
    public  function send($chatId,$message,$keyboard,$reply = '',$parsMode = 'HTML')
    {
        $url = $this->baseUrl.$this->sendPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => $parsMode,
                'chat_id' => $chatId,
                'text' => $message,
                'reply_to_message_id' => $reply,
                'reply_markup' => json_encode(array('keyboard' => $keyboard))
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;
}
    public  function sendToChannel($chatId,$message,$reply = '',$parsMode = 'HTML')
    {
        $url = $this->baseUrl.$this->sendPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => $parsMode,
                'chat_id' => $chatId,
                'text' => $message,
                'reply_to_message_id' => $reply,
                'disable_web_page_preview' => true,
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;
    }
    public function sendPhoto($chatId,$photo,$reply = '')
    {
        $parameter = '/sendPhoto';
        $val = [
            'chat_id' => $chatId,
            'photo' => $photo,
            'reply_to_message_id' => $reply,

            ];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
    public  function sendDocument($chatId,$file)
    {
        $url = $this->baseUrl.$this->sendDocument;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                "chat_id" => $chatId,
                "document" => $file

            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;
    }
    public function forwardMessage($chatId,$fromChatId,$messageId)
    {
        $Url = $this->baseUrl.$this->forwardPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($Url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => 'HTML',
                'chat_id' => $chatId,
                'from_chat_id' => $fromChatId,
                'message_id' => $messageId,
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;


    }
    public function copyMessage($chatId,$fromChatId,$messageId,$caption)
    {
        $Url = $this->baseUrl.$this->copyMessage;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($Url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => 'HTML',
                'chat_id' => $chatId,
                'from_chat_id' => $fromChatId,
                'message_id' => $messageId,
                'caption' => $caption,

            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;


    }
    public function sendLocation($chatId,$latitude,$longitude,$reply = '')
    {

        $val = [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'reply_to_message_id' => $reply,

        ];
        $response =   $this->curl($this->sendLocationPath,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
}
