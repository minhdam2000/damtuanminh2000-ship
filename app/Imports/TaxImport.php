<?php

namespace App\Imports;

use App\Tax;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class TaxImport implements ToModel, WithHeadingRow
{
        public function headingRow() : int
    {
        return 1;
    }
 

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Tax([
            'name' => $row['name'] ,
            'des' => $row['des'] ,
            'unit' => $row['unit'],
            'total' => $row['total'] ,
            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])
        ]);
    }
}
