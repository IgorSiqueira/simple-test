<?php

namespace Tests\Feature;

use App\Models\Covenant;
use App\Models\Custumer;
use App\Models\Debit;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Provider\pt_BR\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class DebitTest extends TestCase
{
    use WithFaker,RefreshDatabase;


    /**
     * Test WebHook receive debit paid.
     */
    public function test_webhook_debit_paid(): void
    {
        $custumer = $this->create_custumer();
        $covenant = $this->create_covenant($custumer);
        $debit = $this->create_debit($covenant);
        $data = [
            'debit_id'=>$debit->id,
            'paid_at'=> $this->faker->dateTimeInInterval('+2 week', '+3 days')->format('Y-m-d H:i:s'),
            'paid_amount'=>$covenant->debt_amount,
            'paid_by'   => $custumer->name
        ];
        $response = $this->postJson(
            'api/debit/paid',
            $data
        );
      
        $response->assertStatus(200);
    }


    private function create_custumer():Custumer
    {   
        $this->faker->addProvider(new Person($this->faker));

        $name = $this->faker->firstName().' '. $this->faker->lastName();
        $cpf = $this->faker->cpf(false);
        $mail = $this->faker->email();

        $data = ['name'=>$name,'document_number'=>$cpf,'email'=>$mail];
       
        $custumer = Custumer::create($data);
       
        return $custumer;
    }

    private function create_covenant(Custumer $custumer)
    {
        $value = $this->faker->randomFloat(2,20,9999);
        $debtDueDate = $this->faker->dateTimeInInterval('+1 week', '+3 days');
        $externalId = $this->faker->randomNumber(5,false);

        $data = ['custumer_id'=>$custumer->id,'debt_amount'=>$value,'debt_due_date'=>$debtDueDate,'external_id'=>$externalId];
       
        $covenant = $custumer->covenant()->create($data);
        return $covenant;
    }

    private function create_debit(Covenant $covenant):Debit
    {
        $data = [];
        $debit = $covenant->debit()->create($data);
        return $debit;
    }
    
}
