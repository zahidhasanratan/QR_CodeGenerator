<?php
namespace App\Imports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TripsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Dump and check the data


        return new Trip([
            'name' => $row['name'] ?? null,
            'email' => $row['email'] ?? null,
            'phone' => $row['phone'] ?? null,
            'driver' => $row['country'] ?? null,
            'gender' => $row['gender'] ?? null,
            'route' => $row['category'] ?? null,
            'description' => $row['organization'] ?? null,
            'fare' => $row['designation'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
