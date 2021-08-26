<?php

namespace Database\Seeders;

use App\Models\Segmentos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SegmentosSeeder extends Seeder
{
    private $data = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->data = [
            [
                'id' => Str::uuid(),
                'nome' => 'Restaurante'
            ],
            [
                'id' => Str::uuid(),
                'nome' => 'Bar'
            ],
            [
                'id' => Str::uuid(),
                'nome' => 'Lanchonete'
            ],
            [
                'id' => Str::uuid(),
                'nome' => 'Pizzaria'
            ]
        ];


        DB::table('segmentos')->insert($this->data);
    }
}
