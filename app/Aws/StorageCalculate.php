<?php

namespace App\Aws;

use Exception;
use Illuminate\Support\Facades\Storage;

class StorageCalculate
{

    public static function getStorageSize()
    {
        $bucketName = env('AWS_BUCKET');

        $instance = new self(); // Create an instance of the class
        $totalSize = $instance->calculateStorageSize($bucketName);

        return response([
            'size' => $totalSize
        ]);
    }
    protected function calculateStorageSize($bucketName)
    {
        $totalSize = 0;

        try {
            $objects = Storage::disk('s3')->allFiles();

            $obj = (object) $objects;

            foreach ($objects as $object) {

                    $totalSize += Storage::disk('s3')->size($object);

            }

            // Convert to human-readable format (e.g., MB, GB)
            $totalSizeInReadableFormat = $this->formatSizeUnits($totalSize);

            return $totalSizeInReadableFormat;
        } catch (Exception $e) {
            // Handle any errors that occur during the process
            return 'Error: ' . $e->getMessage();
        }
    }

    protected function formatSizeUnits($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;

        while ($bytes >= 1024 && $index < 4) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }



}
