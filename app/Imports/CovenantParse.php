<?php

namespace App\Imports;


use App\Models\Covenant;
use App\Models\Custumer;
use App\Utils\NumbersUtils;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class CovenantParse implements OnEachRow,WithStartRow
{
    
    public function startRow(): int
    {
        return 2;
    }

    /*
    #TODO
    Change to use repositoryes
    */
    public function onRow(Row $row)
    {
        $name = $row[0];
        $documentNumber = $row[1];
        $email = $row[2];

        $custumer = Custumer::firstOrCreate(['document_number'=>$documentNumber],
        ['name'=>$name,'email'=>$email,'document_number'=>$documentNumber]);
        if($custumer){

            $externalId = $row[5];
            $dueDate = Carbon::createFromFormat('d/m/Y',$row[4]);
            $debtAmount = NumbersUtils::brl2decimal($row[3], 2);
            $covenent = Covenant::firstOrCreate(['external_id'=>$externalId],
            [
                'custumer_id'=>$custumer->id, 
                'debt_amount'=>$debtAmount,
                'debt_due_date'=>$dueDate->format('Y-m-d'),
                'external_id'=>$externalId
            ]);
        }
    }

   
   
}