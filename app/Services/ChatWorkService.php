<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

final class ChatWorkService
{
    const API_URL_PATTERN = 'https://api.chatwork.com/v2/rooms/%s/messages';

    /** @var string */
    private $apiToken;

    /** @var string */
    private $roomId;

    /** @var Client */
    private $guzzle;

    /**
     * @param string $apiToken
     * @param string $roomId
     * @param Client $guzzle
     */
    public function __construct(string $apiToken, string $roomId, Client $guzzle)
    {
        $this->apiToken = $apiToken;
        $this->roomId = $roomId;
        $this->guzzle = $guzzle;
    }

    /**
     * @param string $title
     * @param string $message
     */
    public function sendMessage(string $title, string $message)
    {
        $url = sprintf(self::API_URL_PATTERN, $this->roomId);

        $this->guzzle->post($url, [
            'form_params' => [
                'body' => sprintf("[info][title]%s[/title]%s[/info]", $title, $message),
            ],
            'headers'     => [
                'X-ChatWorkToken' => $this->apiToken,
            ],
        ]);
    }
}
