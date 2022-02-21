<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'state', 'paid', 'description', 'visa_id', 'type_visa_id', 'center_id', 'user_id', 'rejector_id', 'validator_id', 'transaction_id', 'transaction_status', 'delivered_date', 'expired_date', 'visa_id', 'provenance', 'passport', 'ticket', 'accommodation', 'hotel', 'work', 'imposition', 'passport_type', 'passport_num', 'passport_expiration', 'motif', 'validator_id', 'controlor_id', 'finalisator_id', 'token', 'validatedFiles', 'attestation'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function type_visa() {
        return $this->belongsTo('App\Models\TypeVisa');
    }

    public function center() {
        return $this->belongsTo('App\Models\Center');
    }
}
