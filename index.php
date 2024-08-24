<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get variables from .env file
$sourceBucket = getenv('SOURCE_S3_BUCKET');
$sourceRegion = getenv('SOURCE_S3_REGION');
$sourceKey = getenv('SOURCE_S3_KEY');
$sourceSecret = getenv('SOURCE_S3_SECRET');

$destinationBucket = getenv('DESTINATION_S3_BUCKET');
$destinationRegion = getenv('DESTINATION_S3_REGION');
$destinationKey = getenv('DESTINATION_S3_KEY');
$destinationSecret = getenv('DESTINATION_S3_SECRET');

// Configure source and destination S3 clients
$sourceS3Client = new S3Client([
    'region'  => $sourceRegion,
    'version' => 'latest',
    'credentials' => [
        'key'    => $sourceKey,
        'secret' => $sourceSecret,
    ],
]);

$destinationS3Client = new S3Client([
    'region'  => $destinationRegion,
    'version' => 'latest',
    'credentials' => [
        'key'    => $destinationKey,
        'secret' => $destinationSecret,
    ],
]);

try {
    // List objects in the source bucket
    $objects = $sourceS3Client->listObjectsV2([
        'Bucket' => $sourceBucket,
    ]);

    // Copy each object to the destination bucket
    foreach ($objects['Contents'] as $object) {
        $key = $object['Key'];

        // Copy object to the destination bucket
        $result = $destinationS3Client->copyObject([
            'Bucket'     => $destinationBucket,
            'Key'        => $key,
            'CopySource' => "{$sourceBucket}/{$key}",
        ]);

        echo "Copied {$key} to {$destinationBucket}\n";
    }

    echo "Migration completed successfully.\n";

} catch (AwsException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

