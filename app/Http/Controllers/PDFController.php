<?php

namespace App\Http\Controllers;

use App\Models\CablePower;
use App\Models\Conductor;
use App\Models\Cubicle;
use App\Models\FuseCutOut;
use App\Models\Isolator;
use App\Models\KotakAPP;
use App\Models\KWHMeter;
use App\Models\LBS;
use App\Models\LightningArrester;
use App\Models\MCB;
use App\Models\PHBTR;
use App\Models\TiangListrik;
use App\Models\Trafo;
use App\Models\TrafoArus;
use App\Models\TrafoTegangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ZipArchive;

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

    public function previewPHBTR(string $id)
    {
        $phbtr = PHBTR::findOrFail($id);
        $uids = PHBTR::with('ulp')->get();
        $up3s = PHBTR::with('up3s')->get();
        $pabrikans = PHBTR::with('pabrikan')->get();
        $phbtr->up3s->unit = substr($phbtr->up3s->unit, 4);
        $phbtr->ulp->daerah = substr($phbtr->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($phbtr->tgl_inspeksi) {
            $carbonDate = Carbon::parse($phbtr->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_k', compact('phbtr', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewCubicle(string $id)
    {
        $cubicle = Cubicle::findOrFail($id);
        $uids = Cubicle::with('ulp')->get();
        $up3s = Cubicle::with('up3s')->get();
        $pabrikans = Cubicle::with('pabrikan')->get();
        $cubicle->up3s->unit = substr($cubicle->up3s->unit, 4);
        $cubicle->ulp->daerah = substr($cubicle->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($cubicle->tgl_inspeksi) {
            $carbonDate = Carbon::parse($cubicle->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_j', compact('cubicle', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
    }

    public function previewKotakAPP(string $id)
    {
        $kotak = KotakAPP::findOrFail($id);
        $uids = KotakAPP::with('ulp')->get();
        $up3s = KotakAPP::with('up3s')->get();
        // $pabrikans = KotakAPP::with('pabrikan')->get();
        $kotak->up3s->unit = substr($kotak->up3s->unit, 4);
        $kotak->ulp->daerah = substr($kotak->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($kotak->tgl_inspeksi) {
            $carbonDate = Carbon::parse($kotak->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        return view('pdf.formulir_c', compact('kotak', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));
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

    public function exportPDFphbtr(string $id)
    {
        $phbtr = PHBTR::findOrFail($id);
        $uids = PHBTR::with('ulp')->get();
        $up3s = PHBTR::with('up3s')->get();
        $pabrikans = PHBTR::with('pabrikan')->get();
        $phbtr->up3s->unit = substr($phbtr->up3s->unit, 4);
        $phbtr->ulp->daerah = substr($phbtr->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($phbtr->tgl_inspeksi) {
            $carbonDate = Carbon::parse($phbtr->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_k', compact('phbtr', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($phbtr->no_surat . '.pdf');
    }

    public function exportPDFcubicle(string $id)
    {
        $cubicle = Cubicle::findOrFail($id);
        $uids = Cubicle::with('ulp')->get();
        $up3s = Cubicle::with('up3s')->get();
        $pabrikans = Cubicle::with('pabrikan')->get();
        $cubicle->up3s->unit = substr($cubicle->up3s->unit, 4);
        $cubicle->ulp->daerah = substr($cubicle->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($cubicle->tgl_inspeksi) {
            $carbonDate = Carbon::parse($cubicle->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_j', compact('cubicle', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($cubicle->no_surat . '.pdf');
    }

    public function exportPDFkotakApp(string $id)
    {
        $kotak = KotakAPP::findOrFail($id);
        $uids = KotakAPP::with('ulp')->get();
        $up3s = KotakAPP::with('up3s')->get();
        // $pabrikans = KotakAPP::with('pabrikan')->get();
        $kotak->up3s->unit = substr($kotak->up3s->unit, 4);
        $kotak->ulp->daerah = substr($kotak->ulp->daerah, 4);

        // Pastikan tgl_inspeksi tidak null
        if ($kotak->tgl_inspeksi) {
            $carbonDate = Carbon::parse($kotak->tgl_inspeksi);

            // Konversi angka menjadi teks
            $tanggal = $this->convertNumberToWords($carbonDate->day);
            $bulan = $carbonDate->translatedFormat('F'); // Nama bulan tetap dalam teks
            $tahunDuaDigit = $carbonDate->format('y'); // Ambil 2 digit terakhir tahun
            $tahunTeks = $this->convertNumberToWords($tahunDuaDigit); // Ubah jadi teks
            $hari = $carbonDate->translatedFormat('l'); // Nama hari dalam teks
        } else {
            $tanggal = $bulan = $tahunTeks = $hari = '...............';
        }

        $pdf = Pdf::loadView('pdf.formulir_c', compact('kotak', 'uids', 'up3s', 'tanggal', 'bulan', 'tahunTeks', 'hari'));

        return $pdf->download($kotak->no_surat . '.pdf');
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

    // public function bulkExportPDF(Request $request)
    // {
    //     $request->validate([
    //         'ids' => 'required|json',
    //         'types' => 'required|json'
    //     ]);

    //     $ids = json_decode($request->ids, true);
    //     $types = json_decode($request->types, true);

    //     // Mapping model ke template PDF
    //     $modelToTemplate = [
    //         'App\Models\KWHMeter' => 'pdf.formulir_a',
    //         'App\Models\MCB' => 'pdf.formulir_b',
    //         'App\Models\Trafo' => 'pdf.formulir_f',
    //         'App\Models\CablePower' => 'pdf.formulir_d',
    //         'App\Models\Conductor' => 'pdf.formulir_e',
    //         'App\Models\TrafoArus' => 'pdf.formulir_l',
    //         'App\Models\TrafoTegangan' => 'pdf.formulir_m',
    //         'App\Models\TiangListrik' => 'pdf.formulir_o',
    //         'App\Models\LBS' => 'pdf.formulir_n',
    //         'App\Models\Isolator' => 'pdf.formulir_i',
    //         'App\Models\LightningArrester' => 'pdf.formulir_g',
    //         'App\Models\FuseCutOut' => 'pdf.formulir_h',
    //         'App\Models\PHBTR' => 'pdf.formulir_k',
    //         'App\Models\Cubicle' => 'pdf.formulir_j',
    //         'App\Models\KotakAPP' => 'pdf.formulir_c'
    //     ];

    //     // Buat file ZIP sementara
    //     $zipFileName = 'pdf_export_' . now()->format('Ymd_His') . '.zip';
    //     $zipPath = storage_path('app/public/' . $zipFileName);

    //     $zip = new ZipArchive;
    //     if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
    //         foreach ($ids as $index => $id) {
    //             $type = $types[$index];
    //             $model = $type::find($id);

    //             if ($model && isset($modelToTemplate[$type])) {
    //                 try {
    //                     // Generate PDF sesuai template
    //                     $pdf = Pdf::loadView($modelToTemplate[$type], ['data' => $model]);
    //                     $pdfContent = $pdf->output();

    //                     // Tambahkan ZIP
    //                     $zip->addFromString($model->no_surat . '.pdf' , $pdfContent);
    //                 } catch (\Throwable $th) {
    //                     Log::error("Failed to generate PDF for {$type} ID {$id}: " . $th->getMessage());
    //                     continue;
    //                 }
    //             }
    //         }

    //         $zip->close();

    //         if ($zip->numFiles > 0) {
    //             return response()->download($zipPath)->deleteFileAfterSend(true);
    //         } else {
    //             // Hapus file ZIP
    //             unlink($zipPath);
    //             return back()->with('error', 'Tidak ada PDF yang berhasil dihasilkan');
    //         }
    //     }

    //     return back()->with('error', 'Gagal membuat file ZIP');
    // }

    // public function bulkExportPDF(Request $request)
    // {
    //     $request->validate([
    //         'ids' => 'required|json',
    //         'types' => 'required|json'
    //     ]);

    //     $ids = json_decode($request->ids, true);
    //     $types = json_decode($request->types, true);

    //     // Mapping model ke template PDF dengan flag with_kelas
    //     $modelToTemplate = [
    //         'App\Models\KWHMeter' => ['template' => 'pdf.formulir_a', 'var_name' => 'kWh_Meter', 'with_kelas' => true],
    //         'App\Models\MCB' => ['template' => 'pdf.formulir_b', 'var_name' => 'mcb', 'with_kelas' => false],
    //         'App\Models\Trafo' => ['template' => 'pdf.formulir_f', 'var_name' => 'trafo', 'with_kelas' => false],
    //         'App\Models\CablePower' => ['template' => 'pdf.formulir_d', 'var_name' => 'cable_powers', 'with_kelas' => false],
    //         'App\Models\Conductor' => ['template' => 'pdf.formulir_e', 'var_name' => 'conductor', 'with_kelas' => false],
    //         'App\Models\TrafoArus' => ['template' => 'pdf.formulir_l', 'var_name' => 'trafo_arus', 'with_kelas' => false],
    //         'App\Models\TrafoTegangan' => ['template' => 'pdf.formulir_m', 'var_name' => 'trafo_tegangan', 'with_kelas' => false],
    //         'App\Models\TiangListrik' => ['template' => 'pdf.formulir_o', 'var_name' => 'tiang_listrik', 'with_kelas' => false],
    //         'App\Models\LBS' => ['template' => 'pdf.formulir_n', 'var_name' => 'lbs', 'with_kelas' => false],
    //         'App\Models\Isolator' => ['template' => 'pdf.formulir_i', 'var_name' => 'isolator', 'with_kelas' => false],
    //         'App\Models\LightningArrester' => ['template' => 'pdf.formulir_g', 'var_name' => 'la', 'with_kelas' => false],
    //         'App\Models\FuseCutOut' => ['template' => 'pdf.formulir_h', 'var_name' => 'fco', 'with_kelas' => false],
    //         'App\Models\PHBTR' => ['template' => 'pdf.formulir_k', 'var_name' => 'phbtr', 'with_kelas' => false],
    //         'App\Models\Cubicle' => ['template' => 'pdf.formulir_j', 'var_name' => 'cubicle', 'with_kelas' => false],
    //         'App\Models\KotakAPP' => ['template' => 'pdf.formulir_c', 'var_name' => 'kotak', 'with_kelas' => false]
    //     ];

    //     // Buat file ZIP sementara
    //     $zipFileName = 'pdf_export_' . now()->format('Ymd_His') . '.zip';
    //     $zipPath = storage_path('app/public/' . $zipFileName);

    //     $zip = new ZipArchive;
    //     if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
    //         foreach ($ids as $index => $id) {
    //             $type = $types[$index];

    //             if (!isset($modelToTemplate[$type])) {
    //                 continue;
    //             }

    //             $templateConfig = $modelToTemplate[$type];
    //             $varName = $templateConfig['var_name'];

    //             try {
    //                 // Eager loading relasi dasar
    //                 $query = $type::with(['ulp', 'up3s', 'pabrikan', 'user']);

    //                 // Tambahkan kelasPengujian hanya jika with_kelas true
    //                 if ($templateConfig['with_kelas']) {
    //                     $query->with('kelasPengujian');
    //                 }

    //                 $model = $query->findOrFail($id);

    //                 // Modifikasi data ulp dan up3s jika ada
    //                 if ($model->relationLoaded('up3s') && $model->up3s) {
    //                     $model->up3s->unit = substr($model->up3s->unit, 4);
    //                 }

    //                 if ($model->relationLoaded('ulp') && $model->ulp) {
    //                     $model->ulp->daerah = substr($model->ulp->daerah, 4);
    //                 }

    //                 // Siapkan variabel tanggal
    //                 $dateField = $model->tgl_inspeksi ?? null;
    //                 if ($dateField) {
    //                     $carbonDate = Carbon::parse($dateField);
    //                     $tanggal = $this->convertNumberToWords($carbonDate->day);
    //                     $bulan = $carbonDate->translatedFormat('F');
    //                     $tahunDuaDigit = $carbonDate->format('y');
    //                     $tahunTeks = $this->convertNumberToWords($tahunDuaDigit);
    //                     $hari = $carbonDate->translatedFormat('l');
    //                 } else {
    //                     $tanggal = $bulan = $tahunTeks = $hari = '...............';
    //                 }

    //                 // Siapkan data untuk view
    //                 $viewData = [
    //                     $varName => $model,
    //                     'tanggal' => $tanggal,
    //                     'bulan' => $bulan,
    //                     'tahunTeks' => $tahunTeks,
    //                     'hari' => $hari
    //                 ];

    //                 // Generate PDF
    //                 $pdf = Pdf::loadView($templateConfig['template'], $viewData);
    //                 $pdfContent = $pdf->output();

    //                 // Tambahkan ke ZIP
    //                 $zip->addFromString($model->no_surat . '.pdf', $pdfContent);
    //             } catch (\Throwable $th) {
    //                 Log::error("Failed to generate PDF for {$type} ID {$id}: " . $th->getMessage());
    //                 continue;
    //             }
    //         }

    //         $zip->close();

    //         if ($zip->numFiles > 0) {
    //             return response()->download($zipPath)->deleteFileAfterSend(true);
    //         } else {
    //             unlink($zipPath);
    //             return back()->with('error', 'Tidak ada PDF yang berhasil dihasilkan');
    //         }
    //     }

    //     return back()->with('error', 'Gagal membuat file ZIP');
    // }

    public function bulkExportPDF(Request $request)
    {
        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '512M');
        set_time_limit(300);

        Log::info('===== BULK PDF EXPORT STARTED =====');
        // Log::debug('Request data:', $request->all());

        try {
            // Validate request
            $validated = $request->validate([
                'ids' => 'required|json',
                'types' => 'required|json'
            ]);

            Log::debug('Validation passed');

            $ids = json_decode($request->ids, true);
            $types = json_decode($request->types, true);

            if (!is_array($ids) || !is_array($types)) {
                throw new \Exception("Invalid JSON format for ids or types");
            }

            Log::debug('Decoded IDs and Types:', [
                'ids_count' => count($ids),
                'types_count' => count($types),
                'first_item' => ['id' => $ids[0] ?? null, 'type' => $types[0] ?? null]
            ]);

            // Model to template mapping
            $modelToTemplate = [
                'App\Models\KWHMeter' => ['template' => 'pdf.formulir_a', 'var_name' => 'kWh_Meter', 'with_kelas' => true],
                'App\Models\MCB' => ['template' => 'pdf.formulir_b', 'var_name' => 'mcb', 'with_kelas' => false],
                'App\Models\Trafo' => ['template' => 'pdf.formulir_f', 'var_name' => 'trafo', 'with_kelas' => false],
                'App\Models\CablePower' => ['template' => 'pdf.formulir_d', 'var_name' => 'cable_powers', 'with_kelas' => false],
                'App\Models\Conductor' => ['template' => 'pdf.formulir_e', 'var_name' => 'conductor', 'with_kelas' => false],
                'App\Models\TrafoArus' => ['template' => 'pdf.formulir_l', 'var_name' => 'trafo_arus', 'with_kelas' => false],
                'App\Models\TrafoTegangan' => ['template' => 'pdf.formulir_m', 'var_name' => 'trafo_tegangan', 'with_kelas' => false],
                'App\Models\TiangListrik' => ['template' => 'pdf.formulir_o', 'var_name' => 'tiang_listrik', 'with_kelas' => false],
                'App\Models\LBS' => ['template' => 'pdf.formulir_n', 'var_name' => 'lbs', 'with_kelas' => false],
                'App\Models\Isolator' => ['template' => 'pdf.formulir_i', 'var_name' => 'isolator', 'with_kelas' => false],
                'App\Models\LightningArrester' => ['template' => 'pdf.formulir_g', 'var_name' => 'la', 'with_kelas' => false],
                'App\Models\FuseCutOut' => ['template' => 'pdf.formulir_h', 'var_name' => 'fco', 'with_kelas' => false],
                'App\Models\PHBTR' => ['template' => 'pdf.formulir_k', 'var_name' => 'phbtr', 'with_kelas' => false],
                'App\Models\Cubicle' => ['template' => 'pdf.formulir_j', 'var_name' => 'cubicle', 'with_kelas' => false],
                'App\Models\KotakAPP' => ['template' => 'pdf.formulir_c', 'var_name' => 'kotak', 'with_kelas' => false]
            ];

            // Create temporary ZIP file
            $zipFileName = 'pdf_export_' . now()->format('Ymd_His') . '.zip';
            $zipPath = storage_path('app/public/' . $zipFileName);

            Log::debug('ZIP file path:', ['path' => $zipPath]);

            // Check storage directory
            if (!is_writable(dirname($zipPath))) {
                throw new \Exception("Storage directory is not writable: " . dirname($zipPath));
            }

            $zip = new ZipArchive;
            $zipStatus = $zip->open($zipPath, ZipArchive::CREATE);

            if ($zipStatus !== true) {
                throw new \Exception("Failed to open ZIP file. Error code: " . $zipStatus);
            }

            Log::info('ZIP archive opened successfully');
            Log::debug('Processing ' . count($ids) . ' documents');

            $successCount = 0;
            $errorCount = 0;
            $processedModels = [];

            foreach ($ids as $index => $id) {
                $type = $types[$index] ?? null;
                $logPrefix = "[Item $index] [Type: $type] [ID: $id]";

                try {
                    Log::debug("$logPrefix Processing...");

                    if (!$type || !isset($modelToTemplate[$type])) {
                        Log::warning("$logPrefix Type not found in mapping");
                        $errorCount++;
                        continue;
                    }

                    $templateConfig = $modelToTemplate[$type];
                    Log::debug("$logPrefix Template config:", $templateConfig);

                    // Prepare query with eager loading
                    $query = $type::with(['ulp', 'up3s', 'pabrikan', 'user']);
                    if ($templateConfig['with_kelas']) {
                        $query->with('kelasPengujian');
                    }

                    Log::debug("$logPrefix Fetching model...");
                    $model = $query->find($id);

                    if (!$model) {
                        Log::warning("$logPrefix Model not found");
                        $errorCount++;
                        continue;
                    }

                    Log::debug("$logPrefix Model found:", ['no_surat' => $model->no_surat]);

                    // Modify relations if they exist
                    if ($model->relationLoaded('up3s') && $model->up3s) {
                        $model->up3s->unit = substr($model->up3s->unit, 4);
                        Log::debug("$logPrefix Modified up3s unit");
                    }

                    if ($model->relationLoaded('ulp') && $model->ulp) {
                        $model->ulp->daerah = substr($model->ulp->daerah, 4);
                        Log::debug("$logPrefix Modified ulp daerah");
                    }

                    // Prepare date variables
                    $dateField = $model->tgl_inspeksi ?? null;
                    if ($dateField) {
                        $carbonDate = Carbon::parse($dateField);
                        $tanggal = $this->convertNumberToWords($carbonDate->day);
                        $bulan = $carbonDate->translatedFormat('F');
                        $tahunDuaDigit = $carbonDate->format('y');
                        $tahunTeks = $this->convertNumberToWords($tahunDuaDigit);
                        $hari = $carbonDate->translatedFormat('l');
                        Log::debug("$logPrefix Date processed:", compact('tanggal', 'bulan', 'tahunTeks', 'hari'));
                    } else {
                        $tanggal = $bulan = $tahunTeks = $hari = '...............';
                        Log::debug("$logPrefix No inspection date found");
                    }

                    // Prepare view data
                    $viewData = [
                        $templateConfig['var_name'] => $model,
                        'tanggal' => $tanggal,
                        'bulan' => $bulan,
                        'tahunTeks' => $tahunTeks,
                        'hari' => $hari
                    ];

                    Log::debug("$logPrefix Generating PDF...");
                    $pdf = Pdf::loadView($templateConfig['template'], $viewData);
                    $pdfContent = $pdf->output();

                    // Add to ZIP
                    $filename = $model->no_surat . '.pdf';
                    $zip->addFromString($filename, $pdfContent);
                    $successCount++;
                    $processedModels[] = $filename;

                    Log::info("$logPrefix Successfully added to ZIP: $filename");
                } catch (\Throwable $th) {
                    $errorCount++;
                    Log::error("$logPrefix Error processing document", [
                        'error' => $th->getMessage(),
                        'trace' => $th->getTraceAsString()
                    ]);
                    continue;
                }
            }

            $zip->close();
            Log::info("Bulk export completed. Success: $successCount, Errors: $errorCount");

            if ($successCount > 0) {
                Log::debug('Sending ZIP file to client');
                return response()->download($zipPath)->deleteFileAfterSend(true);
            } else {
                if (file_exists($zipPath)) {
                    unlink($zipPath);
                }
                Log::warning('No files were generated');
                return back()
                    ->with('error', 'Tidak ada PDF yang berhasil dihasilkan')
                    ->with('details', "Error: $errorCount dokumen gagal diproses");
            }
        } catch (\Throwable $mainTh) {
            Log::error('MAIN ERROR:', [
                'error' => $mainTh->getMessage(),
                'trace' => $mainTh->getTraceAsString()
            ]);

            // Clean up ZIP file if exists
            if (isset($zipPath) && file_exists($zipPath)) {
                unlink($zipPath);
            }

            return back()
                ->with('error', 'Terjadi kesalahan sistem')
                ->with('details', $mainTh->getMessage());
        } finally {
            Log::info('===== BULK PDF EXPORT FINISHED =====');
        }
    }
}
