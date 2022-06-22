<?php

namespace App\Manager;

use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\File\File;

class UploadImageS3Manager
{
    const DIRECTORY = 'upload/';

    /**
     * @var S3Client
     */
    private $client;

    /**
     * @var string
     */
    private $bucket;

    public function __construct()
    {
        $this->setBucket($_ENV['BUCKET_NAME']);
        $this->setClient(
            new S3Client([
                'version' => $_ENV['VERSION'],
                'region' => $_ENV['REGION'],
                'credentials' => ['key' => $_ENV['AWS_S3_ACCESS_ID'], 'secret' => $_ENV['AWS_S3_ACCESS_SECRET']]
            ])
        );
    }

    public function upload(File $file): string
    {
        $fileName = $file->getFilename() . "." . explode("/", $file->getMimeType())[1];
        $fileContent = $file->getContent();
        $path = static::DIRECTORY . $fileName;
        $this->getClient()->upload($this->getBucket(), $path, $fileContent)->toArray()['ObjectURL'];
        return $path;
    }

    /**
     * @return S3Client
     */
    private function getClient(): S3Client
    {
        return $this->client;
    }

    /**
     * @param S3Client $client
     */
    private function setClient(S3Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    private function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @param string $bucket
     */
    private function setBucket(string $bucket): void
    {
        $this->bucket = $bucket;
    }
}
