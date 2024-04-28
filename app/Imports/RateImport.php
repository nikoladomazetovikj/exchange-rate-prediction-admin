<?php

namespace App\Imports;

use App\Models\Rate;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RateImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $date = Carbon::createFromFormat('d.m.Y', $row['date'])->format('Y-m-d');

        return new Rate([
            'date' => $date,
            'rate' => $row['rate'],
        ]);
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'rate' => 'required',
        ];
    }
}
