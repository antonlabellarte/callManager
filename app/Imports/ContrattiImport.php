<?php

namespace App\Imports;

use App\Models\CustomersList;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContrattiImport implements ToModel, WithHeadingRow
{
    protected $campaignID;

    // Passiamo il valore al costruttore
    public function __construct($campaignID)
    {
        $this->campaignID = $campaignID;
    }

    public function model(array $row)
    {
        return new CustomersList([
            'customerID' => $row['customerid'], // nome colonna Excel
            'campaignID' => $this->campaignID
        ]);
    }
}