<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'column_name_1' => $row['excel_column_1'],
            'column_name_2' => $row['excel_column_2'],
            // Sesuaikan dengan nama kolom di model Product Anda dan nama kolom di file Excel.
        ]);
    }
}
