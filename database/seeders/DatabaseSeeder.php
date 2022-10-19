<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\User;
use App\Models\Games;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Games::create([
        //     'judul_game' => 'Mobile Legend',
        //     'gambar' => 'https://cdn0-production-images-kly.akamaized.net/Hyl2S_OHDEDCGayRTeriz3hPi38=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3488932/original/008102000_1624278462-Mobile_Legends_11.jpg',
        //     'harga' => '50.000'
        // ]);

        // Games::create([
        //     'judul_game' => 'Free Fire',
        //     'gambar' => 'https://cdn0-production-images-kly.akamaized.net/XvOOh8erhrPXkMSKXv7MTArJqYM=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/4058234/original/090110200_1655708618-Logo_Baru_Free_Fire.jpg',
        //     'harga' => '80.000'
        // ]);
        // Games::create([
        //     'judul_game' => 'Valorant',
        //     'gambar' => 'https://cdn1-production-images-kly.akamaized.net/2cz3nNAb61C_WtZDIByp9jys2Ww=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3142622/original/000361800_1591163362-valorant-2.jpg',
        //     'harga' => '150.000'
        // ]);
        // Games::create([
        //     'judul_game' => 'Clash Of Clans',
        //     'gambar' => 'https://tampang.com/tm_images/article/e3cbf0009a71d021.jpg',
        //     'harga' => '100.000'
        // ]);

        // Admin::create([
        //     'username' => 'anwar',
        //     'password' => Hash::make('anwar')
        // ]);

        // User::create([
        //     'name' => 'User',
        //     'email' => '',
        //     'password' => Hash::make('user')
        // ]);

        Kategori::create([
            'kategori' => 'Pulsa',
            'kategori_img' => 'https://cdn.icon-icons.com/icons2/41/PNG/128/phone_7135.png'
        ]);
        Kategori::create([
            'kategori' => 'Games',
            'kategori_img' => 'https://cdn.icon-icons.com/icons2/58/PNG/256/nintendosnesgamepad_snesnintendo_jueg_11835.png'
        ]);
        Kategori::create([
            'kategori' => 'PLN',
            'kategori_img' => 'https://cdn.icon-icons.com/icons2/2033/PNG/512/eco_energy_bulb_renewable_electric_electricity_ecology_icon_124129.png'
        ]);
    }
}
