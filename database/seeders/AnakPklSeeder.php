<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnakPklSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Faker Indonesia

        $bidang = [
            1 => 'Sekretariat',
            2 => 'PIKP',
            3 => 'TIK',
            4 => 'Statistik',
            5 => 'Persandian'
        ];

        $tingkat = ['S1', 'D3', 'SMA/K'];

        $jenisKelamin = ['Laki-laki', 'Perempuan'];

        $data = [];

        for ($i = 1; $i <= 25; $i++) {
            $jk = $faker->randomElement($jenisKelamin);
            $unit = $faker->numberBetween(1, 5);

            $data[] = [
                'nama_lengkap' => $faker->name($jk == 'Laki-laki' ? 'male' : 'female'),
                'asal_instansi' => $faker->company,
                'program_studi' => $faker->randomElement([
                    'Teknik Informatika', 'Manajemen Informatika',
                    'Rekayasa Perangkat Lunak', 'Statistika',
                    'Ilmu Komunikasi', 'Keamanan Siber'
                ]),
                'tingkat' => $faker->randomElement($tingkat),
                'nomor_induk' => $faker->numerify('##########'),
                'email' => $faker->unique()->safeEmail,
                'no_hp' => $faker->phoneNumber,
                'jenis_kelamin' => $jk,
                'alamat_domisili' => $faker->address,
                'tanggal_mulai' => $faker->dateTimeBetween('2025-07-01', '2026-07-31')->format('Y-m-d'),
                'tanggal_selesai' => $faker->dateTimeBetween('2025-09-01', '2026-10-31')->format('Y-m-d'),
                'unit_penempatan' => $unit,
                'pembimbing_instansi' => $faker->name,
                'pembimbing_lapangan' => $faker->name,
                'status' => $faker->randomElement(['Aktif', 'Selesai']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tbl_anak_pkl')->insert($data);
    }
}
