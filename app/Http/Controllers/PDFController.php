<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\FuseCutOut;
use App\Models\Isolator;
use App\Models\KWHMeter;
use App\Models\LBS;
use App\Models\LightningArrester;
use App\Models\MCB;
use App\Models\TiangListrik;
use App\Models\Trafo;
use App\Models\TrafoArus;
use App\Models\TrafoTegangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

Carbon::setLocale('id');
setlocale(LC_TIME, 'id_ID.utf8');

class PDFController extends Controller
{
    public function previewKWH(string $id)
    {
        $kWh_Meter = KWHMeter::findOrFail($id);
        $uids = KWHMeter::with('ulp')->get();
        $up3s = KWHMeter::with('up3s')->get();
        $pabrikans = KWHMeter::with('pabrikan')->get();
        $kWh_Meter->up3s->unit = substr($kWh_Meter->up3s->unit, 4);
        $kWh_Meter->ulp->daerah = substr($kWh_Meter->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($kWh_Meter->tgl_inspeksi) {
            $carbonDate = Carbon::parse($kWh_Meter->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_a', compact('kWh_Meter', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewMCB(string $id)
    {
        $mcb = MCB::findOrFail($id);
        $uids = MCB::with('ulp')->get();
        $up3s = MCB::with('up3s')->get();
        $pabrikans = MCB::with('pabrikan')->get();
        $user = MCB::with('user')->find($id);
        $mcb->up3s->unit = substr($mcb->up3s->unit, 4);
        $mcb->ulp->daerah = substr($mcb->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($mcb->tgl_inspeksi) {
            $carbonDate = Carbon::parse($mcb->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_b', compact('mcb', 'uids', 'up3s', 'pabrikans', 'user', 'tanggal', 'bulan', 'tahunDuaDigit', 'tahunTeks', 'hari'));
    }

    public function previewTrafo(string $id)
    {
        $trafo = Trafo::findOrFail($id);
        $uids = Trafo::with('ulp')->get();
        $up3s = Trafo::with('up3s')->get();
        $pabrikans = Trafo::with('pabrikan')->get();
        $trafo->up3s->unit = substr($trafo->up3s->unit, 4);
        $trafo->ulp->daerah = substr($trafo->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_f', compact('trafo', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewCable(string $id)
    {
        $cable_powers = CablePower::findOrFail($id);
        $uids = CablePower::with('ulp')->get();
        $up3s = CablePower::with('up3s')->get();
        $pabrikans = CablePower::with('pabrikan')->get();
        $cable_powers->up3s->unit = substr($cable_powers->up3s->unit, 4);
        $cable_powers->ulp->daerah = substr($cable_powers->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($cable_powers->tgl_inspeksi) {
            $carbonDate = Carbon::parse($cable_powers->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_d', compact('cable_powers', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewConductor(string $id)
    {
        $conductor = Conductor::findOrFail($id);
        $uids = Conductor::with('ulp')->get();
        $up3s = Conductor::with('up3s')->get();
        $pabrikans = Conductor::with('pabrikan')->get();
        $conductor->up3s->unit = substr($conductor->up3s->unit, 4);
        $conductor->ulp->daerah = substr($conductor->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($conductor->tgl_inspeksi) {
            $carbonDate = Carbon::parse($conductor->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_e', compact('conductor', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewCT(string $id)
    {
        $trafo_arus = TrafoArus::findOrFail($id);
        $uids = TrafoArus::with('ulp')->get();
        $up3s = TrafoArus::with('up3s')->get();
        $pabrikans = TrafoArus::with('pabrikan')->get();
        $trafo_arus->up3s->unit = substr($trafo_arus->up3s->unit, 4);
        $trafo_arus->ulp->daerah = substr($trafo_arus->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo_arus->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo_arus->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_l', compact('trafo_arus', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewPT(string $id)
    {
        $trafo_tegangan = TrafoTegangan::findOrFail($id);
        $uids = TrafoTegangan::with('ulp')->get();
        $up3s = TrafoTegangan::with('up3s')->get();
        $pabrikans = TrafoTegangan::with('pabrikan')->get();
        $trafo_tegangan->up3s->unit = substr($trafo_tegangan->up3s->unit, 4);
        $trafo_tegangan->ulp->daerah = substr($trafo_tegangan->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo_tegangan->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo_tegangan->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_m', compact('trafo_tegangan', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewTiangListrik(string $id)
    {
        $tiang_listrik = TiangListrik::findOrFail($id);
        $uids = TiangListrik::with('ulp')->get();
        $up3s = TiangListrik::with('up3s')->get();
        $pabrikans = TiangListrik::with('pabrikan')->get();
        $tiang_listrik->up3s->unit = substr($tiang_listrik->up3s->unit, 4);
        $tiang_listrik->ulp->daerah = substr($tiang_listrik->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($tiang_listrik->tgl_inspeksi) {
            $carbonDate = Carbon::parse($tiang_listrik->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_o', compact('tiang_listrik', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewLBS(string $id)
    {
        $lbs = LBS::findOrFail($id);
        // Decode data elektrik dari JSON
        $dataElektrik = json_decode($lbs->data_elektrik, true);

        // Hitung kesesuaian untuk masing-masing fasa
        $kesesuaianElektrik = [
            'RS' => [
                'persentase' => $dataElektrik['persentase']['perbedaanRS'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanRS'] ?? 0) <= 20
            ],
            'RT' => [
                'persentase' => $dataElektrik['persentase']['perbedaanRT'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanRT'] ?? 0) <= 20
            ],
            'ST' => [
                'persentase' => $dataElektrik['persentase']['perbedaanST'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanST'] ?? 0) <= 20
            ],
            'overall' => $lbs->kesesuaian_elektrik
        ];
        $uids = LBS::with('ulp')->get();
        $up3s = LBS::with('up3s')->get();
        $pabrikans = LBS::with('pabrikan')->get();
        $lbs->up3s->unit = substr($lbs->up3s->unit, 4);
        $lbs->ulp->daerah = substr($lbs->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($lbs->tgl_inspeksi) {
            $carbonDate = Carbon::parse($lbs->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_n', compact('lbs', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari', 'kesesuaianElektrik'));
    }

    public function previewIsolator(string $id)
    {
        $isolator = Isolator::findOrFail($id);
        $uids = Isolator::with('ulp')->get();
        $up3s = Isolator::with('up3s')->get();
        $pabrikans = Isolator::with('pabrikan')->get();
        $isolator->up3s->unit = substr($isolator->up3s->unit, 4);
        $isolator->ulp->daerah = substr($isolator->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($isolator->tgl_inspeksi) {
            $carbonDate = Carbon::parse($isolator->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_i', compact('isolator', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewLightningArrester(string $id)
    {
        $la = LightningArrester::findOrFail($id);
        $uids = LightningArrester::with('ulp')->get();
        $up3s = LightningArrester::with('up3s')->get();
        $pabrikans = LightningArrester::with('pabrikan')->get();
        $la->up3s->unit = substr($la->up3s->unit, 4);
        $la->ulp->daerah = substr($la->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($la->tgl_inspeksi) {
            $carbonDate = Carbon::parse($la->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_g', compact('la', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewFCO(string $id)
    {
        $fco = FuseCutOut::findOrFail($id);
        $uids = FuseCutOut::with('ulp')->get();
        $up3s = FuseCutOut::with('up3s')->get();
        $pabrikans = FuseCutOut::with('pabrikan')->get();
        $fco->up3s->unit = substr($fco->up3s->unit, 4);
        $fco->ulp->daerah = substr($fco->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($fco->tgl_inspeksi) {
            $carbonDate = Carbon::parse($fco->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_h', compact('fco', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    // Fungsi untuk mengubah angka menjadi teks dalam Bahasa Indonesia
    private function convertNumberToWords($num)
    {
        $num = (int) $num;
        $angka = [
            "",
            "Satu",
            "Dua",
            "Tiga",
            "Empat",
            "Lima",
            "Enam",
            "Tujuh",
            "Delapan",
            "Sembilan",
            "Sepuluh",
            "Sebelas",
            "Dua Belas",
            "Tiga Belas",
            "Empat Belas",
            "Lima Belas",
            "Enam Belas",
            "Tujuh Belas",
            "Delapan Belas",
            "Sembilan Belas"
        ];
        $puluhan = [
            "",
            "",
            "Dua Puluh",
            "Tiga Puluh",
            "Empat Puluh",
            "Lima Puluh",
            "Enam Puluh",
            "Tujuh Puluh",
            "Delapan Puluh",
            "Sembilan Puluh"
        ];

        if ($num < 20) {
            return $angka[$num];
        } elseif ($num < 100) {
            return $puluhan[intdiv($num, 10)] . " " . $angka[$num % 10];
        } else {
            return $num; // Untuk angka di atas 99 (tidak mungkin terjadi di tahun dua digit)
        }
    }


    public function exportPDFkwh(string $id)
    {
        // Tambahkan with('kelasPengujian') untuk eager loading relasi
        $kWh_Meter = KWHMeter::with(['ulp', 'up3s', 'pabrikan', 'user', 'kelasPengujian'])->findOrFail($id);

        // Data-data lain yang tidak digunakan di blade tidak perlu di-load
        $kWh_Meter->up3s->unit = substr($kWh_Meter->up3s->unit, 4);
        $kWh_Meter->ulp->daerah = substr($kWh_Meter->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($kWh_Meter->tgl_inspeksi) {
            $carbonDate = Carbon::parse($kWh_Meter->tgl_inspeksi);
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F');
            $tahunDuaDigit = $carbonDate->format('y');
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit);
            $hari = $carbonDate->translatedFormat('l');
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_a', compact('kWh_Meter', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($kWh_Meter->no_surat . '.pdf');
    }

    public function exportPDFmcb(string $id)
    {
        $mcb = MCB::findOrFail($id);
        $uids = MCB::with('ulp')->get();
        $up3s = MCB::with('up3s')->get();
        $pabrikans = MCB::with('pabrikan')->get();
        $user = MCB::with('user')->find($id);
        $mcb->up3s->unit = substr($mcb->up3s->unit, 4);
        $mcb->ulp->daerah = substr($mcb->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($mcb->tgl_inspeksi) {
            $carbonDate = Carbon::parse($mcb->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_b', compact('mcb', 'uids', 'up3s', 'pabrikans', 'user', 'tanggal', 'bulan', 'tahunDuaDigit', 'tahunTeks', 'hari'));

        return $pdf->download($mcb->no_surat . '.pdf');
    }

    public function exportPDFtrafo(string $id)
    {
        $trafo = Trafo::findOrFail($id);
        $uids = Trafo::with('ulp')->get();
        $up3s = Trafo::with('up3s')->get();
        $pabrikans = Trafo::with('pabrikan')->get();
        $trafo->up3s->unit = substr($trafo->up3s->unit, 4);
        $trafo->ulp->daerah = substr($trafo->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_f', compact('trafo', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($trafo->no_surat . '.pdf');
    }

    public function exportPDFcable(string $id)
    {
        $cable_powers = CablePower::findOrFail($id);
        $uids = CablePower::with('ulp')->get();
        $up3s = CablePower::with('up3s')->get();
        $pabrikans = CablePower::with('pabrikan')->get();
        $cable_powers->up3s->unit = substr($cable_powers->up3s->unit, 4);
        $cable_powers->ulp->daerah = substr($cable_powers->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($cable_powers->tgl_inspeksi) {
            $carbonDate = Carbon::parse($cable_powers->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_d', compact('cable_powers', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($cable_powers->no_surat . '.pdf');
    }

    public function exportPDFconductor(string $id)
    {
        $conductor = Conductor::findOrFail($id);
        $uids = Conductor::with('ulp')->get();
        $up3s = Conductor::with('up3s')->get();
        $pabrikans = Conductor::with('pabrikan')->get();
        $conductor->up3s->unit = substr($conductor->up3s->unit, 4);
        $conductor->ulp->daerah = substr($conductor->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($conductor->tgl_inspeksi) {
            $carbonDate = Carbon::parse($conductor->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_e', compact('conductor', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($conductor->no_surat . '.pdf');
    }

    public function exportPDFct(string $id)
    {
        $trafo_arus = TrafoArus::findOrFail($id);
        $uids = TrafoArus::with('ulp')->get();
        $up3s = TrafoArus::with('up3s')->get();
        $pabrikans = TrafoArus::with('pabrikan')->get();
        $trafo_arus->up3s->unit = substr($trafo_arus->up3s->unit, 4);
        $trafo_arus->ulp->daerah = substr($trafo_arus->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo_arus->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo_arus->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_l', compact('trafo_arus', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($trafo_arus->no_surat . '.pdf');
    }

    public function exportPDFpt(string $id)
    {
        $trafo_tegangan = TrafoTegangan::findOrFail($id);
        $uids = TrafoTegangan::with('ulp')->get();
        $up3s = TrafoTegangan::with('up3s')->get();
        $pabrikans = TrafoTegangan::with('pabrikan')->get();
        $trafo_tegangan->up3s->unit = substr($trafo_tegangan->up3s->unit, 4);
        $trafo_tegangan->ulp->daerah = substr($trafo_tegangan->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($trafo_tegangan->tgl_inspeksi) {
            $carbonDate = Carbon::parse($trafo_tegangan->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_m', compact('trafo_tegangan', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($trafo_tegangan->no_surat . '.pdf');
    }

    public function exportPDFtiangListrik(string $id)
    {
        $tiang_listrik = TiangListrik::findOrFail($id);
        $uids = TiangListrik::with('ulp')->get();
        $up3s = TiangListrik::with('up3s')->get();
        $pabrikans = TiangListrik::with('pabrikan')->get();
        $tiang_listrik->up3s->unit = substr($tiang_listrik->up3s->unit, 4);
        $tiang_listrik->ulp->daerah = substr($tiang_listrik->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($tiang_listrik->tgl_inspeksi) {
            $carbonDate = Carbon::parse($tiang_listrik->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_o', compact('tiang_listrik', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($tiang_listrik->no_surat . '.pdf');
    }

    public function exportPDFlbs(string $id)
    {
        $lbs = LBS::findOrFail($id);
        // Decode data elektrik dari JSON
        $dataElektrik = json_decode($lbs->data_elektrik, true);

        // Hitung kesesuaian untuk masing-masing fasa
        $kesesuaianElektrik = [
            'RS' => [
                'persentase' => $dataElektrik['persentase']['perbedaanRS'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanRS'] ?? 0) <= 20
            ],
            'RT' => [
                'persentase' => $dataElektrik['persentase']['perbedaanRT'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanRT'] ?? 0) <= 20
            ],
            'ST' => [
                'persentase' => $dataElektrik['persentase']['perbedaanST'] ?? 0,
                'sesuai' => ($dataElektrik['persentase']['perbedaanST'] ?? 0) <= 20
            ],
            'overall' => $lbs->kesesuaian_elektrik
        ];
        $uids = LBS::with('ulp')->get();
        $up3s = LBS::with('up3s')->get();
        $pabrikans = LBS::with('pabrikan')->get();
        $lbs->up3s->unit = substr($lbs->up3s->unit, 4);
        $lbs->ulp->daerah = substr($lbs->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($lbs->tgl_inspeksi) {
            $carbonDate = Carbon::parse($lbs->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_n', compact('lbs', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari', 'kesesuaianElektrik'));

        return $pdf->download($lbs->no_surat . '.pdf');
    }

    public function exportPDFisolator(string $id)
    {
        $isolator = Isolator::findOrFail($id);
        $uids = Isolator::with('ulp')->get();
        $up3s = Isolator::with('up3s')->get();
        $pabrikans = Isolator::with('pabrikan')->get();
        $isolator->up3s->unit = substr($isolator->up3s->unit, 4);
        $isolator->ulp->daerah = substr($isolator->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($isolator->tgl_inspeksi) {
            $carbonDate = Carbon::parse($isolator->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_i', compact('isolator', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($isolator->no_surat . '.pdf');
    }

    public function exportPDFlightningarrester(string $id)
    {
        $la = LightningArrester::findOrFail($id);
        $uids = LightningArrester::with('ulp')->get();
        $up3s = LightningArrester::with('up3s')->get();
        $pabrikans = LightningArrester::with('pabrikan')->get();
        $la->up3s->unit = substr($la->up3s->unit, 4);
        $la->ulp->daerah = substr($la->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($la->tgl_inspeksi) {
            $carbonDate = Carbon::parse($la->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_g', compact('la', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($la->no_surat . '.pdf');
    }

    public function exportPDFfco(string $id)
    {
        $fco = FuseCutOut::findOrFail($id);
        $uids = FuseCutOut::with('ulp')->get();
        $up3s = FuseCutOut::with('up3s')->get();
        $pabrikans = FuseCutOut::with('pabrikan')->get();
        $fco->up3s->unit = substr($fco->up3s->unit, 4);
        $fco->ulp->daerah = substr($fco->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($fco->tgl_inspeksi) {
            $carbonDate = Carbon::parse($fco->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_h', compact('fco', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($fco->no_surat . '.pdf');
    }

    // Generate Bulk PDF
    public function generateBulkPdf(array $ids, array $types)
    {
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/public/bulk_retur_' . now()->timestamp . '.zip');

        if ($zip->open($zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($ids as $index => $id) {
                try {
                    $pdfContent = $this->generateSinglePdf($types[$index], $id);
                    $zip->addFromString(
                        $this->generatePdfName($types[$index], $id),
                        $pdfContent->output()
                    );
                } catch (\Throwable $th) {
                    Log::error("Failed to add {$types[$index]} ID {$id} to ZIP: " . $th->getMessage());
                    continue;
                }
            }
            $zip->close();
        }

        return $zipFileName;
    }

    public function generateSinglePdf($type, $id)
    {
        $model = app($type)->with([
            'up3',
            'gudang',
            'kelasPengujian',
            'user',
            'approvedBy'
        ])->find($id);

        if (!$model) {
            throw new \Exception("Data not found: {$type} ID {$id}");
        }

        switch ($type) {
            case 'App\Models\KWHMeter':
                $response = $this->exportPDFkwh($id);
                return $response->getOriginalContent();
            case 'App\Models\MCB':
                return $this->exportPDFmcb($id)->getOriginalContent();
            default:
                abort(404, 'Jenis material tidak didukung');
        }
    }

    private function convertDate($date)
    {
        if (!$date) return [
            'tanggal' => '-',
            'bulan' => '-',
            'tahunTeks' => '-',
            'hari' => '-'
        ];

        $carbonDate = Carbon::parse($date);
        return [
            'tanggal' => $this->convertNumberToWords($carbonDate->day),
            'bulan' => $carbonDate->translatedFormat('F'),
            'tahunTeks' => $this->convertNumberToWords($carbonDate->format('y')),
            'hari' => $carbonDate->translatedFormat('l')
        ];
    }

    private function generatePdfName($type, $id)
    {
        $model = app($type)->find($id);
        if (!$model) {
            throw new \Exception("Model not found for type: {$type} ID {$id}");
        }
        $prefix = strtolower(class_basename($type));
        return "{$prefix}_{$model->no_surat}.pdf";
    }
}
