<?php

// v1   - CSV service

namespace App\Services;

class CsvService
{
    public static function createDownload($data, array $mapping, $fileName = 'export.csv')
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () use ($data, $mapping) {
            $file = fopen('php://output', 'w');
            // Write header row using the mapping values as column titles
            fputcsv($file, array_values($mapping));
            foreach ($data as $item) {
                $row = [];
                foreach (array_keys($mapping) as $key) {
                    if (is_object($item)) {
                        $row[] = $item->$key;
                    } elseif (is_array($item)) {
                        $row[] = isset($item[$key]) ? $item[$key] : '';
                    } else {
                        $row[] = '';
                    }
                }
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
