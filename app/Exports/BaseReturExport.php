<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

abstract class BaseReturExport implements WithHeadings, WithMapping
{
    abstract public function modelType(): string;

    abstract public function customHeadings(): array;

    abstract public function customMap($item): array;

    public function headings(): array
    {
        return array_merge(
            [
                'No. Retur',
                'Tgl. Inspeksi',
                'ULP',
                'Jenis Material'
            ],

            $this->customHeadings(),
            [
                'Kesimpulan',
                'Status'
            ]
        );
    }

    public function map($item): array
    {
        return array_merge(
            [
                $item->no_surat,
                $item->tgl_inspeksi,
                $item->ulp->daerah ?? '-',
                $this->modelType()
            ],

            $this->customMap($item),
            [
                $item->kesimpulan ?? '-',
                $item->status ?? '-'
            ]
        );
    }
}
