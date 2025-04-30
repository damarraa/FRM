<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetExport implements WithMultipleSheets
{
    protected $exports;

    public function __construct(array $exports)
    {
        $this->exports = $exports;
    }

    public function sheets(): array
    {
        return $this->exports;
    }
}
