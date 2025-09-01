<?php

namespace App\Imports;

use App\Models\CustomersList;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContrattiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CustomersList([
            'customerID' => $row['customerid'], // attenzione: il nome deve corrispondere all'header nel file Excel
            // 'campaignID' => ... se vuoi impostarlo staticamente o dinamicamente
        ]);
    }
}