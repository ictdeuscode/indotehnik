<?php

namespace App\Exports;

use App\Models\MasterPreorder;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PreorderExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $excludeFields = [
        'id', // Exclude the password column
        'created_at', // Exclude the created_at column
        'updated_at', // Exclude the updated_at column
    ];

    public function query()
    {
        return MasterPreorder::query()->select(array_diff(Schema::getColumnListing('master_preorders'), $this->excludeFields));
    }

    public function headings(): array
    {
        // Get all the column names except the excluded columns
        $columns = Schema::getColumnListing('master_preorders');
        $columns = array_diff($columns, $this->excludeFields);

        // Return the column names as headings
        return $columns;
    }
}
