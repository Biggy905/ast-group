<?php

namespace application\common\components\HttpClient;

use application\common\components\urls\interfaces\UrlInterface;
use application\common\components\HttpClient\enums\MethodHttpEnum;
use Symfony\Component\HttpClient\HttpClient as SymfonyClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

final class HttpClient
{
    public function exec(
        MethodHttpEnum $methodHttpEnum,
        UrlInterface   $url,
        ?array $headers = null,
        ?array $payloads = null,
        ?array $json = null,
        ?array $queries = null,
    ): array {
        $method = $methodHttpEnum->takeMethod();
        $currentUrl = $url->getUrl();

        $client = SymfonyClient::create();

        $options = [];
        if (!empty($headers)) {
            $options = array_merge($options, ['headers' => $headers]);
        }

        if (!empty($payloads)) {
            $options = array_merge($options, ['body' => $payloads]);
        }

        if (!empty($json)) {
            $options = array_merge($options, ['json' => $json]);
        }

        if (!empty($queries)) {
            $options = array_merge($options, ['query' => $queries]);
        }

        $response = $client->request(
            $method,
            $currentUrl,
            $options
        );

        try {
            return [
                'code' => $response->getStatusCode(),
                'body' => $response->getContent(false),
            ];
        } catch (
        ClientExceptionInterface
        | RedirectionExceptionInterface
        | ServerExceptionInterface
        | TransportExceptionInterface $e
        ) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}