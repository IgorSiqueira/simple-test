<?php

namespace Tests\Feature;

use Database\Seeders\JobStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class CovenantTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Convent import csv.
     */
    public function test_upload_csv(): void
    {
        $this->seed(JobStatusSeeder::class);
        
        $header = 'nome,cpf ou cnpj,email,valor total,data da cobrança,id_externo';
        $row1 = 'Igor Santos Siqueira,120447616202,igor@igor.com.br,"R$ 100.000,00",05/05/2023,1';
        $row2 = 'Igor Santos Siqueira,120447616202,igor@igor.com.br,"R$ 150,00",05/04/2023,2';
        $row3 = 'Pedro Henrique,29568935649,pedro@pedro.com.br,"R$ 150,00",05/04/2023,3';
        $row4 = 'Pedro Henrique,29568935649,pedro@pedro.com.br,"R$ 150,00",05/04/2023,4';
        $row5 = 'Pedro Henrique,29568935649,pedro@pedro.com.br,"R$ 150,00",05/04/2023,4';
        $content = implode("\n", [$header, $row1, $row2,$row3,$row4,$row5]);
        $data = [
            'file' =>
                UploadedFile::
                    fake()->
                    createWithContent(
                        'Test.csv',
                        $content
                    )
        ];
        $response = $this->postJson(
            'api/covenants',
            $data
        );
        $response->assertOk();

        

    }
}
