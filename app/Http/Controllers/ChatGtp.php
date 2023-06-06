<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatGtp extends Controller
{
    


    public function llamada(Request $request){
        //$client = new Client(['base_uri' => config('services.chatgpt.base_uri')]);

        $client = new Client(['base_uri' => config('services.chatgpt.base_uri')]);

        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
            'json' => [
                "model"=> "text-davinci-003",
                'prompt' => 'Hello, how are you?',
                'max_tokens' => 0,
                'temperature' => 0.5,
            ],
        ]);
        
        $completion = json_decode((string) $response->getBody(), true)['choices'][0]['text'];
        
    }
}
