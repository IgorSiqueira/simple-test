<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Covenant extends Model
{
    use HasFactory;
    protected $table = 'covenants';
    protected $fillable = ['custumer_id', 'debt_amount','debt_due_date','external_id'];

    public function custumer(): BelongsTo
	{
		return $this->belongsTo(Custumer::class, 'custumer_id', 'id');
	}

    public function debit(): HasOne
    {
        return $this->hasOne(Debit::class, 'covenant_id', 'id');
    }
}
