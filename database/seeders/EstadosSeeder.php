<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
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
                "id" => "03831D10-032A-4E64-8FD1-3CD4BE93D2C6",
                "nome" => "São Paulo",
                "sigla" => "SP"
            ],
            [
                "id" => "04A6320D-46E2-4462-BA34-A26E85BD9065",
                "nome" => "Rio de Janeiro",
                "sigla" => "RJ"
            ],
            [
                "id" => "19C45F24-0598-4958-B429-79994E6439A5",
                "nome" => "Minas Gerais",
                "sigla" => "MG"
            ],
            [
                "id" => "24159C24-7F7C-4A19-AA53-65096CD6A752",
                "nome" => "Ceará",
                "sigla" => "CE"
            ],
            [
                "id" => "26EEAD31-944F-4503-9AF7-D6D9485C1680",
                "nome" => "Paraná",
                "sigla" => "PR"
            ],
            [
                "id" => "32104DA5-91E8-406D-A49A-22CD1D2299F7",
                "nome" => "Amapá",
                "sigla" => "AP"
            ],
            [
                "id" => "44C45045-6AD1-4525-8775-4A593FBD81FA",
                "nome" => "Tocantins",
                "sigla" => "TO"
            ],
            [
                "id" => "535CBC7A-B85A-4F27-8412-157ED9CE477B",
                "nome" => "Acre",
                "sigla" => "AC"
            ],
            [
                "id" => "5631108D-0441-44DD-A69A-17B7FF0855C2",
                "nome" => "Sergipe",
                "sigla" => "SE"
            ],
            [
                "id" => "600DB7FE-4516-44E5-AB2B-3C5163404DCF",
                "nome" => "Maranhão",
                "sigla" => "MA"
            ],
            [
                "id" => "6294A321-83AE-4212-9C34-A90F891A9D8F",
                "nome" => "Goiás",
                "sigla" => "GO"
            ],
            [
                "id" => "66743F9C-CBE1-425F-B49A-E83FF62A43C8",
                "nome" => "Roraima",
                "sigla" => "RR"
            ],
            [
                "id" => "769B4197-867F-41C8-898D-7C353F902C3B",
                "nome" => "Piauí",
                "sigla" => "PI"
            ],
            [
                "id" => "82A4C52A-6EBB-4A03-BD8E-14D6622967B8",
                "nome" => "Amazonas",
                "sigla" => "AM"
            ],
            [
                "id" => "86AFD2B7-0D59-4573-8827-1DC855401232",
                "nome" => "Rondônia",
                "sigla" => "RO"
            ],
            [
                "id" => "86DE655D-99D7-40DC-BC4B-04EADDD0B720",
                "nome" => "Rio Grande do Norte",
                "sigla" => "RN"
            ],
            [
                "id" => "896D8ED3-C6B1-4FD9-B591-254061491A06",
                "nome" => "Paraíba",
                "sigla" => "PB"
            ],
            [
                "id" => "8BF11842-71A9-4CB7-A087-AEA9980A47CE",
                "nome" => "Pará",
                "sigla" => "PA"
            ],
            [
                "id" => "9F8C2739-7396-4F7F-A73E-02A99EE3424C",
                "nome" => "Distrito Federal",
                "sigla" => "DF"
            ],
            [
                "id" => "B0AA1484-65C6-4CAD-AFA1-2E432B26C4A3",
                "nome" => "Pernambuco",
                "sigla" => "PE"
            ],
            [
                "id" => "B99059E1-7992-4ECF-87B1-72B71F44AD56",
                "nome" => "Alagoas",
                "sigla" => "AL"
            ],
            [
                "id" => "C558A209-C1A5-4892-8741-99A8EE8BBE70",
                "nome" => "Santa Catarina",
                "sigla" => "SC"
            ],
            [
                "id" => "CE605863-2C19-430D-A6F8-90DDBB97FDA9",
                "nome" => "Espírito Santo",
                "sigla" => "ES"
            ],
            [
                "id" => "CE768F7D-EC29-4346-9CF8-278F18D2C74C",
                "nome" => "Mato Grosso do Sul",
                "sigla" => "MS"
            ],
            [
                "id" => "EE44C53B-C6C6-4239-BBDD-F2A3C5858EA2",
                "nome" => "Mato Grosso",
                "sigla" => "MT"
            ],
            [
                "id" => "EFAC3505-26AE-4B1C-B898-D6B972C16870",
                "nome" => "Bahia",
                "sigla" => "BA"
            ],
            [
                "id" => "FA62D40D-ADDD-431A-A684-4A14339A2706",
                "nome" => "Rio Grande do Sul",
                "sigla" => "RS"
            ]
        ];

        DB::table('estados')->insert($this->data);
    }
}
