<?php

namespace App\Imports;

use App\Models\Campaigns;
use App\Models\CampagneDuplicate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContrattiImport implements ToCollection, WithHeadingRow
{
    public $countCorretti = 0;
    public $countDuplicati = 0;

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $row = $row->toArray(); // Converti Collection in array

            if (!isset($row['id'], $row['regolaid'])) {
                continue; // Salta righe malformate
            }

            // Se non esiste, lo inserisce normalmente
            if (!Campaigns::where('id', $row['id'])->exists()) {
                Campaigns::create([
                    'id'       => $row['id'],
                    'regolaid' => $row['regolaid'],
                ]);

            $this->countCorretti++;
            } else {
                // Se già esiste, salva nella tabella duplicati
                CampagneDuplicate::create([
                    'id' => $row['id'],
                    'regolaid'    => $row['regolaid'],
                ]);

            $this->countDuplicati++;
            }
        }
    }
    
    public function chunkSize(): int
    {
        return 1000; // processa 1000 righe alla volta
    }
}
