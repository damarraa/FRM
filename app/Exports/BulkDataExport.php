<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BulkDataExport implements WithMultipleSheets
{
    protected $groupedData;

    public function __construct(array $groupedData)
    {
        $this->groupedData = $groupedData;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->groupedData as $modelClass => $ids) {
            // Buat sheet untuk setiap tipe model
            $exportClass = $this->getExportClass($modelClass);
            if ($exportClass) {
                $sheets[] = new $exportClass($ids);
            }
        }

        return $sheets;
    }

    protected function getExportClass($modelClass)
    {
        // Mapping antara model class dan export class
        $mapping = [
            'App\Models\KWHMeter' => 'App\Exports\KWHMeterExport',
            'App\Models\MCB' => 'App\Exports\MCBExport',
            'App\Models\Trafo' => 'App\Exports\TrafoExport',
            'App\Models\CablePower' => 'App\Exports\CablePowerExport',
            'App\Models\Conductor' => 'App\Exports\ConductorExport',
            'App\Models\TrafoArus' => 'App\Exports\TrafoArusExport',
            'App\Models\TrafoTegangan' => 'App\Exports\TrafoTeganganExport',
            'App\Models\TiangListrik' => 'App\Exports\TiangLIstrikExport',
            'App\Models\LBS' => 'App\Exports\LBSExport',
            'App\Models\Isolator' => 'App\Exports\IsolatorExport',
            'App\Models\LightningArrester' => 'App\Exports\LightningArresterExport',
            'App\Models\FuseCutOut' => 'App\Exports\FCOExport',
            'App\Models\PHBTR' => 'App\Exports\PHBTRExport',
            'App\Models\Cubicle' => 'App\Exports\CubicleExport',
            'App\Models\KotakAPP' => 'App\Exports\KotakAPPExport'
        ];

        return $mapping[$modelClass] ?? null;
    }
}
