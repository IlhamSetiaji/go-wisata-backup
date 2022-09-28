<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'home1' => 'hRerEpZiBh7zZ7QMpresz6JRrudtI51TdCCZouTu.jpg',
                'about1' => '1635820808.png',
                'about2' => '1635820863.png',
                'video' => 'fVkMCnIag5hJBmcib1DbxLyVZpnf3THM7NbqjvdX.m4v',
                'sponsor2' => 'M6tArxfpgeFQwhH1w1BfRTE8MyNY0EwB6TK9juEM.png',
                'sponsor3' => 'T64pdhTeyN3z7t1mrGc5pI9FmYbcm25NVDh32Ilg.png',
                'sponsor4' => 'StXyLxV1qhJ5MZXfbuLIl2eSm7MDuACcpFf06gno.png',
                'experience1' => 'bSce8EQdWA1uCax5AFdY9zPJSY4KU3TaRVXTsQWg.jpg',
                'experience2' => 'evZ9hldbe01WUiByRGPT6GSNOkW0mQ0wkO9H3GSc.jpg',
                'created_at' => \Carbon\Carbon::now(),
            ],

        ];

        foreach ($settings as $set) {
            Setting::firstOrcreate([
                'home1' => $set['home1'],
                'about1' => $set['about1'],
                'about2' => $set['about2'],
                'video' => $set['video'],
                'sponsor2' => $set['sponsor2'],
                'sponsor3' => $set['sponsor3'],
                'sponsor4' => $set['sponsor4'],
                'experience1' => $set['experience1'],
                'experience2' => $set['experience2'],
                'created_at' => $set['created_at']
            ]);
        }
    }
}
