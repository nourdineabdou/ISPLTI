<?php

namespace App\Services;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class OneDriveService
{
    private $graph;

    public function __construct()
    {
        $this->graph = new Graph();
        $this->graph->setAccessToken($this->getAccessToken());
    }

    private function getAccessToken()
    {
        $clientId = env('MICROSOFT_CLIENT_ID');
        $clientSecret = env('MICROSOFT_CLIENT_SECRET');
        $tenantId = env('MICROSOFT_TENANT_ID');
        $url = "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token";

        $response = \Http::asForm()->post($url, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials',
        ]);

        return $response->json()['access_token'];
    }

    public function getFileContent($filePath)
    {
        $driveItem = $this->graph->createRequest('GET', "/me/drive/root:/$filePath:/content")
            ->setReturnType(Model\DriveItem::class)
            ->execute();
        return $driveItem;
    }

}
