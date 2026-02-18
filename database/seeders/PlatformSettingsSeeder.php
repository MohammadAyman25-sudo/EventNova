<?php

namespace Database\Seeders;

use App\Models\PlatformSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'refund_enabled',
                'value' => false,
                'type' => 'boolean',
                'description' => 'Globally enable/disable refund requests & processing',
            ],
            [
                'key' => 'platform_commission_percent',
                'value' => 10,
                'type' => 'percent',
                'description' => 'Platform fee taken from each ticket sale (0-100)',
            ]
        ];

        foreach ($settings as $setting) {
            PlatformSetting::create($setting);
        }
    }
}
