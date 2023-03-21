<?php

namespace App\Imports;

use App\Fintem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class FinImport implements ToModel, WithHeadingRow
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
        print_r ($row);
        echo "<br>";
        if($row[""] ==null){
           return null;
        }        return new Fintem([
            'name' => $row['noi_dung'] ,
            'des' => $row['ghi_chu'],
            'stt' => $row['stt'],
            'myid' => $row['ma_so'],
            'money' => $row['so_tien'],
        ]);
    }
}
