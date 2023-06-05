<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MediaServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('media_services')->insert([
            'platform_name' => 'cloudinary',
            'account' => 'gacembekhira@gmail.com',
            'api_env' => 'CLOUDINARY_URL=cloudinary://697681641587646:1j3m7MMiTefgyNYvfSaiJZyTrCE@dbnslnawc',
            'account_credentials' => json_encode([
                'email' => 'gacembekhira@gmail.com',
                'password' => 'Rahan@175*',
            ]),
        ]);
    }
}
