# generic-csv-generator

## Features / What is it?

This is a simple class to create CSV files

## Donate

Find this project useful? You can support me with a Paypal donation:

[Make Paypal Donation](https://www.paypal.com/donate/?hosted_button_id=2XCS6R3CTC5BA)

## Usage

You can map the column names to the fields of the collection, like below.

In controller:

```php
$data = $Product::all();

$mapping = [
    'id' => 'ID',
    'project_name' => 'Project name',
];

$download_response = CsvService::createDownload($data, $mapping, 'export.csv');

return download_response;
```
