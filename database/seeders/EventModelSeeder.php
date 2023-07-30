<?php

namespace Database\Seeders;

use App\Models\EventModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
            'event' => 'Cita #1',
            'start_date' => '2023-07-11 10:00',
            'end_date' => '2023-07-11 11:00'
            ],
            [
                'event' => 'Cita #2',
                'start_date' => '2023-07-12 12:00',
                'end_date' => '2023-07-12 13:00'
            ],
            [
                'event' => 'Cita #3',
                'start_date' => '2023-07-14 15:00',
                'end_date' => '2023-07-14 16:00'
            ],
            [
                'event' => 'Cita #4',
                'start_date' => '2023-07-11 17:00',
                'end_date' => '2023-07-11 18:00'
            ],

        ];

        foreach ($events as $event) {
            EventModel::create($event);
        }
    }
}
