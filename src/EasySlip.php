<?php

namespace M4h45amu7x;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Utils;
use M4h45amu7x\Response;
use M4h45amu7x\exceptions\VerifyException;

require 'vendor/autoload.php';

class EasySlip
{
    private string $key;
    private string $endpoint;

    /**
     * Constructs a new EasySlip client with the provided API key.
     *
     * @param string $key - The API key for authentication.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->endpoint = 'https://developer.easyslip.com/api/v1/verify';
    }

    /**
     * Verifies the slip by payload using the EasySlip API.
     *
     * @param string $payload - The data payload to be verified.
     * @return Response - The verification result.
     * @throws EasySlipVerifyError - If the verification request fails.
     */
    public function verifyByPayload(string $payload): Response
    {
        try {
            $client = new Client();
            $response = $client->get($this->endpoint, [
                'query' => [
                    'payload' => $payload,
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->key,
                ],
                'verify' => false
            ]);

            $data = json_decode($response->getBody(), true);

            return new Response($data['status'], $data['data']);
        } catch (RequestException $error) {
            if ($error->hasResponse()) {
                $responseData = json_decode($error->getResponse()->getBody()->getContents(), true);
                throw new VerifyException($responseData);
            }

            throw $error;
        }
    }

    /**
     * Verifies the slip by image file using the EasySlip API.
     *
     * @param string $imagePath - The image to be verified.
     * @return Response - The verification result.
     * @throws EasySlipVerifyError - If the verification request fails.
     */
    public function verifyByImage(string $imagePath): Response
    {
        try {
            $client = new Client();
            $response = $client->post($this->endpoint, [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => Utils::tryFopen($imagePath, 'r')
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->key
                ],
                'verify' => false
            ]);

            $data = json_decode($response->getBody(), true);

            return new Response($data['status'], $data['data']);
        } catch (RequestException $error) {
            if ($error->hasResponse()) {
                $responseData = json_decode($error->getResponse()->getBody()->getContents(), true);
                throw new VerifyException($responseData);
            }

            throw $error;
        }
    }
}
