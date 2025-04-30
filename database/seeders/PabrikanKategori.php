<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PabrikanKategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['pabrikan_id' => 1, 'kategori_id' => 2], // PT ABB Sakti Industri -> MCB
            ['pabrikan_id' => 1, 'kategori_id' => 10], // PT ABB Sakti Industri -> Cubicle
            ['pabrikan_id' => 2, 'kategori_id' => 3], // PT Alum Central Mandiri Lestari -> Power Cable
            ['pabrikan_id' => 2, 'kategori_id' => 4], // PT Alum Central Mandiri Lestari -> Konduktor MV
            ['pabrikan_id' => 3, 'kategori_id' => 10], // PT Arlisco Elektrika Perkasa -> Cubicle
            ['pabrikan_id' => 3, 'kategori_id' => 13], // PT Arlisco Elektrika Perkasa -> Load Break Switch
            ['pabrikan_id' => 4, 'kategori_id' => 5], // PT Asata Utama -> Transformator Distribusi
            ['pabrikan_id' => 5, 'kategori_id' => 15], // PT Bakrie Pipe Industries -> Tiang Baja
            ['pabrikan_id' => 6, 'kategori_id' => 5], // PT Bambang Djaja -> Transformator Distribusi
            ['pabrikan_id' => 6, 'kategori_id' => 11], // PT Bambang Djaja -> CT
            ['pabrikan_id' => 6, 'kategori_id' => 12], // PT Bambang Djaja -> PT
            ['pabrikan_id' => 7, 'kategori_id' => 3], // PT BICC Berca Cables -> Power Cable
            ['pabrikan_id' => 7, 'kategori_id' => 4], // PT BICC Berca Cables -> Konduktor MV
            ['pabrikan_id' => 8, 'kategori_id' => 1], // PT Cannet Elektrik Indonesia -> KWH Meter 1
            ['pabrikan_id' => 9, 'kategori_id' => 3], // PT Central Wire Industrial -> Power Cable
            ['pabrikan_id' => 9, 'kategori_id' => 4], // PT Central Wire Industrial -> Konduktor MV
            ['pabrikan_id' => 10, 'kategori_id' => 15], // PT Citra Dian Perkasa -> Tiang Baja
            ['pabrikan_id' => 11, 'kategori_id' => 3], // PT Citra Mahasurya Industries -> Power Cable
            ['pabrikan_id' => 11, 'kategori_id' => 4], // PT Citra Mahasurya Industries -> Konduktor MV
            ['pabrikan_id' => 12, 'kategori_id' => 1], // PT Citra Sanxing Indonesia -> KWH Meter 1
            ['pabrikan_id' => 13, 'kategori_id' => 15], // PT Duta Hita Jaya -> Tiang Baja
            ['pabrikan_id' => 14, 'kategori_id' => 13], // PT Duta Terang Rubberindo -> Load Break Switch
            ['pabrikan_id' => 15, 'kategori_id' => 14], // PT EDMI Indonesia -> KWH Meter 3
            ['pabrikan_id' => 16, 'kategori_id' => 9], // PT Ega Tekelindo Prima -> PHBTR
            ['pabrikan_id' => 16, 'kategori_id' => 10], // PT Ega Tekelindo Prima -> Cubicle
            ['pabrikan_id' => 17, 'kategori_id' => 9], // PT Electra Inti Perkasa -> Konduktor MV
            ['pabrikan_id' => 17, 'kategori_id' => 14], // PT Electra Inti Perkasa -> KWH Meter 3
            ['pabrikan_id' => 18, 'kategori_id' => 13], // PT Entec Electric Indonesia -> Load Break Switch
            ['pabrikan_id' => 19, 'kategori_id' => 11], // PT Esitas Pacific -> CT
            ['pabrikan_id' => 19, 'kategori_id' => 12], // PT Esitas Pacific -> PT
            ['pabrikan_id' => 20, 'kategori_id' => 16], // PT Frilay Beton -> Tiang Beton
            ['pabrikan_id' => 21, 'kategori_id' => 1], // PT Fuji Dharma Electric -> KWH Meter 1
            ['pabrikan_id' => 22, 'kategori_id' => 15], // PT Gaharu Putra Baja Mandiri -> Tiang Baja
            ['pabrikan_id' => 23, 'kategori_id' => 7], // PT Graha Sumber Energi -> Isolator
            ['pabrikan_id' => 24, 'kategori_id' => 10], // PT Guna Era Manufaktura -> Cubicle
            ['pabrikan_id' => 25, 'kategori_id' => 6], // PT Gunabangsa Teknik Industri -> Fuse Cut OUt
            ['pabrikan_id' => 25, 'kategori_id' => 7], // PT Gunabangsa Teknik Industri -> Isolaor
            ['pabrikan_id' => 25, 'kategori_id' => 8], // PT Gunabangsa Teknik Industri -> Lightning Arrester
            ['pabrikan_id' => 26, 'kategori_id' => 1], // PT Hexing Technology -> KWH Meter 1
            ['pabrikan_id' => 26, 'kategori_id' => 14], // PT Hexing Technology -> KWH Meter 3
            ['pabrikan_id' => 27, 'kategori_id' => 13], // PT Hezong Elektrik Indonesia -> Load Break Switch
            ['pabrikan_id' => 28, 'kategori_id' => 16], // PT Hume Sakti Indonesia -> Tiang Beton
            ['pabrikan_id' => 29, 'kategori_id' => 16], // PT Indoconst Persada -> Tiang Beton
            ['pabrikan_id' => 30, 'kategori_id' => 13], // PT INES -> Load Break Switch
            ['pabrikan_id' => 31, 'kategori_id' => 7], // PT Insindo Inti Abadi -> Isolator
            ['pabrikan_id' => 32, 'kategori_id' => 16], // PT Jaya Beton Indonesia -> Tiang Beton
            ['pabrikan_id' => 33, 'kategori_id' => 15], // PT Jaya Mandiri Steel -> Tiang Baja
            ['pabrikan_id' => 34, 'kategori_id' => 16], // PT Jaya Sentrikon Indonesia -> Tiang Beton
            ['pabrikan_id' => 35, 'kategori_id' => 3], // PT Jembo Cable Company Tbk -> Power Cable
            ['pabrikan_id' => 35, 'kategori_id' => 4], // PT Jembo Cable Company Tbk -> Konduktor MV
            ['pabrikan_id' => 36, 'kategori_id' => 4], // PT Kabelindo Murni Tbk -> Konduktor MV
            ['pabrikan_id' => 37, 'kategori_id' => 16], // PT Kalimantan Agung -> Tiang Beton
            ['pabrikan_id' => 38, 'kategori_id' => 5], // PT Kalla Electrical Systems -> Transformator Distribusi
            ['pabrikan_id' => 39, 'kategori_id' => 16], // PT Kencana Teknikatama Sentosa -> Tiang Beton
            ['pabrikan_id' => 40, 'kategori_id' => 7], // PT Kensaki Polimer Indonesia -> Isolator
            ['pabrikan_id' => 41, 'kategori_id' => 7], // PT Kentjana Sakti Indonesia -> Isolator
            ['pabrikan_id' => 42, 'kategori_id' => 6], // PT Kilat Wahana Jenggala -> Fuse Cut Out
            ['pabrikan_id' => 42, 'kategori_id' => 8], // PT Kilat Wahana Jenggala -> Lightning Arrester
            ['pabrikan_id' => 43, 'kategori_id' => 3], // PT KMI Wire And Cable Tbk -> Power Cable
            ['pabrikan_id' => 43, 'kategori_id' => 4], // PT KMI Wire And Cable Tbk -> Konduktor MV
            ['pabrikan_id' => 44, 'kategori_id' => 16], // PT Kunango Jantan -> Tiang Beton
            ['pabrikan_id' => 45, 'kategori_id' => 9], // PT Kurnia Abadi Padang -> PHBTR
            ['pabrikan_id' => 46, 'kategori_id' => 5], // PT Lucky Light Globalindo -> Transformator Distribusi
            ['pabrikan_id' => 47, 'kategori_id' => 3], // PT Magnakabel Nusantara -> Power Cable
            ['pabrikan_id' => 47, 'kategori_id' => 4], // PT Magnakabel Nusantara -> Konduktor MV
            ['pabrikan_id' => 48, 'kategori_id' => 15], // PT Makmur Jaya -> Tiang Baja
            ['pabrikan_id' => 49, 'kategori_id' => 13], // PT Marina Corporindo -> Load Break Switch
            ['pabrikan_id' => 50, 'kategori_id' => 15], // PT Masrur & Son -> Tiang Baja
            ['pabrikan_id' => 51, 'kategori_id' => 5], // PT Mastergreen Electric -> Transformator Distribusi
            ['pabrikan_id' => 52, 'kategori_id' => 5], // PT Mastra Mulia Mandiri -> Transformator Distribusi
            ['pabrikan_id' => 53, 'kategori_id' => 5], // PT Maxima Daya Indonesia -> Transformator Distribusi
            ['pabrikan_id' => 54, 'kategori_id' => 1], // PT Mecoindo -> KWH Meter 1
            ['pabrikan_id' => 54, 'kategori_id' => 14], // PT Mecoindo -> KWH Meter 3
            ['pabrikan_id' => 55, 'kategori_id' => 2], // PT Mega Cipta Bangsa -> MCB
            ['pabrikan_id' => 56, 'kategori_id' => 5], // PT Mega Karya Perkasa -> Transformator Distribusi
            ['pabrikan_id' => 56, 'kategori_id' => 9], // PT Mega Karya Perkasa -> PHBTR
            ['pabrikan_id' => 57, 'kategori_id' => 3], // PT Mega Kharisma Makmur -> Power Cable
            ['pabrikan_id' => 57, 'kategori_id' => 4], // PT Mega Kharisma Makmur -> Konduktor MV
            ['pabrikan_id' => 58, 'kategori_id' => 1], // PT Melcoinda -> KWH Meter 1
            ['pabrikan_id' => 59, 'kategori_id' => 5], // PT Morawa Electric Transbuana -> Transformator Distribusi
            ['pabrikan_id' => 60, 'kategori_id' => 3], // PT Multi Kencana Niagatama -> Power Cable
            ['pabrikan_id' => 60, 'kategori_id' => 4], // PT Multi Kencana Niagatama -> Konduktor MV
            ['pabrikan_id' => 61, 'kategori_id' => 9], // PT Mulya Utama Mandiri Sentosa -> PHBTR
            ['pabrikan_id' => 62, 'kategori_id' => 9], // PT Nurinda -> PHBTR
            ['pabrikan_id' => 63, 'kategori_id' => 3], // PT Nusantara Electric -> Power Cable
            ['pabrikan_id' => 63, 'kategori_id' => 4], // PT Nusantara Electric -> Konduktor MV
            ['pabrikan_id' => 64, 'kategori_id' => 9], // PT Panel Mulia Total -> PHBTR
            ['pabrikan_id' => 65, 'kategori_id' => 16], // PT Perkasa Beton Readymix -> Tiang Beton
            ['pabrikan_id' => 66, 'kategori_id' => 3], // PT Power Cable Indonesia -> Power Cable
            ['pabrikan_id' => 66, 'kategori_id' => 4], // PT Power Cable Indonesia -> Konduktor MV
            ['pabrikan_id' => 67, 'kategori_id' => 6], // PT Powerindo Prima Perkasa -> Fuse Cut Out
            ['pabrikan_id' => 67, 'kategori_id' => 7], // PT Powerindo Prima Perkasa -> Isolator
            ['pabrikan_id' => 67, 'kategori_id' => 8], // PT Powerindo Prima Perkasa -> Lightning Arrester
            ['pabrikan_id' => 67, 'kategori_id' => 9], // PT Powerindo Prima Perkasa -> PHBTR
            ['pabrikan_id' => 68, 'kategori_id' => 3], // PT Prima Cable Indo -> Power Cable
            ['pabrikan_id' => 68, 'kategori_id' => 4], // PT Prima Cable Indo -> Konduktor MV
            ['pabrikan_id' => 69, 'kategori_id' => 3], // PT Prima Indah Lestari -> Power Cable
            ['pabrikan_id' => 69, 'kategori_id' => 4], // PT Prima Indah Lestari -> Konduktor MV
            ['pabrikan_id' => 70, 'kategori_id' => 3], // PT Prysmian Cables Indonesia -> Power Cable
            ['pabrikan_id' => 70, 'kategori_id' => 4], // PT Prysmian Cables Indonesia -> Konduktor MV
            ['pabrikan_id' => 71, 'kategori_id' => 3], // PT Pulung Cable Indonesia -> Power Cable
            ['pabrikan_id' => 71, 'kategori_id' => 4], // PT Pulung Cable Indonesia -> Konduktor MV
            ['pabrikan_id' => 72, 'kategori_id' => 9], // PT Pura Mayungan -> PHBTR
            ['pabrikan_id' => 73, 'kategori_id' => 9], // PT Rahmat Kurnia Abadi -> PHBTR
            ['pabrikan_id' => 74, 'kategori_id' => 15], // PT Raja Besi -> Tiang Baja
            ['pabrikan_id' => 75, 'kategori_id' => 16], // PT Ratu Pola Bumi -> Tiang Beton
            ['pabrikan_id' => 76, 'kategori_id' => 2], // PT Schneider Indonesia -> MCB
            ['pabrikan_id' => 76, 'kategori_id' => 5], // PT Schneider Indonesia -> Transformator Distribusi
            ['pabrikan_id' => 76, 'kategori_id' => 10], // PT Schneider Indonesia -> Cubicle
            ['pabrikan_id' => 76, 'kategori_id' => 13], // PT Schneider Indonesia -> Load Break Switch
            ['pabrikan_id' => 77, 'kategori_id' => 16], // PT Sentosa Sakti Makmur -> Tiang Beton
            ['pabrikan_id' => 78, 'kategori_id' => 7], // PT Serambi Gayo Sentosa -> Isolator
            ['pabrikan_id' => 79, 'kategori_id' => 1], // PT Siemens Indonesia -> Cubicle
            ['pabrikan_id' => 80, 'kategori_id' => 6], // PT Sinarindo Wiranusa Elektrik -> Fuse Cut Out
            ['pabrikan_id' => 80, 'kategori_id' => 7], // PT Sinarindo Wiranusa Elektrik -> Isolator
            ['pabrikan_id' => 80, 'kategori_id' => 8], // PT Sinarindo Wiranusa Elektrik -> Lightning Arrester
            ['pabrikan_id' => 81, 'kategori_id' => 16], // PT Sinergi Beton Utama -> Tiang Beton
            ['pabrikan_id' => 82, 'kategori_id' => 5], // PT Sintra Sinarindo Elektrik -> Transformator Distribusi
            ['pabrikan_id' => 82, 'kategori_id' => 13], // PT Sintra Sinarindo Elektrik -> Load Break Switch
            ['pabrikan_id' => 83, 'kategori_id' => 1], // PT Smart Meter Indonesia -> KWH Meter 1
            ['pabrikan_id' => 84, 'kategori_id' => 15], // PT Spindo (Steel Pipe Industry of Indonesia) -> Tiang Baja
            ['pabrikan_id' => 85, 'kategori_id' => 15], // PT Srirejeki Perdana Steel -> Tiang Baja
            ['pabrikan_id' => 86, 'kategori_id' => 3], // PT Sucaco, Tbk -> Power Cable
            ['pabrikan_id' => 87, 'kategori_id' => 16], // PT Sumbetri Megah -> Tiang Beton
            ['pabrikan_id' => 88, 'kategori_id' => 3], // PT Sumi Indo Kabel Tbk -> Power Cable
            ['pabrikan_id' => 88, 'kategori_id' => 4], // PT Sumi Indo Kabel Tbk -> Konduktor MV
            ['pabrikan_id' => 89, 'kategori_id' => 15], // PT Surya Putera Pagaruyung -> Tiang Baja
            ['pabrikan_id' => 90, 'kategori_id' => 4], // PT Suryakabel Cemerlang -> Konduktor MV
            ['pabrikan_id' => 91, 'kategori_id' => 3], // PT Sutrakabel Intimandiri -> Power Cable
            ['pabrikan_id' => 92, 'kategori_id' => 5], // PT Symphos Electric -> Transformator Distribusi
            ['pabrikan_id' => 92, 'kategori_id' => 9], // PT Symphos Electric -> PHBTR
            ['pabrikan_id' => 93, 'kategori_id' => 16], // PT Tiang Beton BRM -> Tiang Beton
            ['pabrikan_id' => 94, 'kategori_id' => 15], // PT Tiga Pilar Sakato -> Tiang Baja
            ['pabrikan_id' => 95, 'kategori_id' => 15], // PT Tjakrindo Mas -> Tiang Baja
            ['pabrikan_id' => 95, 'kategori_id' => 16], // PT Tjakrindo Mas -> Tiang Beton
            ['pabrikan_id' => 96, 'kategori_id' => 16], // PT Tonggak Ampuh -> Tiang Beton
            ['pabrikan_id' => 97, 'kategori_id' => 5], // PT Trafoindo Prima Perkasa -> Transformator Distribusi
            ['pabrikan_id' => 97, 'kategori_id' => 11], // PT Trafoindo Prima Perkasa -> CT
            ['pabrikan_id' => 97, 'kategori_id' => 12], // PT Trafoindo Prima Perkasa -> PT
            ['pabrikan_id' => 98, 'kategori_id' => 9], // PT Travesindo Multi Elektrik -> PHBTR
            ['pabrikan_id' => 99, 'kategori_id' => 9], // PT Trias Indra Saputra -> PHBTR
            ['pabrikan_id' => 100, 'kategori_id' => 5], // PT Triputra Electric Abadi -> Transformator Distribusi
            ['pabrikan_id' => 101, 'kategori_id' => 9], // PT Tritunggal Swarna -> PHBTR
            ['pabrikan_id' => 102, 'kategori_id' => 11], // PT TS Transformer Indonesia -> CT 
            ['pabrikan_id' => 103, 'kategori_id' => 7], // PT Twink Indonesia -> Isolator
            ['pabrikan_id' => 104, 'kategori_id' => 10], // PT Ulusoy Electric Industry -> Cubicle
            ['pabrikan_id' => 105, 'kategori_id' => 16], // PT Virajaya Riauputra -> Tiang Beton
            ['pabrikan_id' => 106, 'kategori_id' => 3], // PT Voksel Electric Tbk -> Power Cable
            ['pabrikan_id' => 106, 'kategori_id' => 4], // PT Voksel Electric Tbk -> Konduktor MV
            ['pabrikan_id' => 107, 'kategori_id' => 3], // PT Walsin Lippo Industries -> Power Cable
            ['pabrikan_id' => 107, 'kategori_id' => 4], // PT Walsin Lippo Industries -> Konduktor MV
            ['pabrikan_id' => 108, 'kategori_id' => 16], // PT Wijaya Karya Beton -> Tiang Beton
            ['pabrikan_id' => 109, 'kategori_id' => 4], // PT ZTT Cable Indonesia -> Konduktor MV
        ];

        DB::table('pabrikan_kategoris')->insert($data);
    }
}
