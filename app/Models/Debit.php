<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debit extends Model
{
    use HasFactory;

    protected $table = 'debits';
    protected $fillable = ['covenant_id','paid_at', 'paid_amount','paid_by'];

    public function covenant(): BelongsTo
	{
		return $this->belongsTo(Covenant::class, 'covenant_id', 'id');
	}
}
