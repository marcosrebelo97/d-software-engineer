<?php

namespace App\Infrastructure\Laravel\Users;

use GuzzleHttp\Client;

class ViaCepService
{
    public function getAddressByCep($cep)
    {
        $client = new Client();
        $response = $client->get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        }

        return null;
    }
}
