<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Custumer extends Model
{
    use HasFactory;

    protected $table = 'custumers';
    protected $fillable = ['name', 'document_number','email'];


    public function covenant(): HasMany
    {
        return $this->hasMany(Covenant::class, 'custumer_id', 'id');
    }

}
