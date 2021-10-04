<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmartSwitchDualLog extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'bot_id', 'smart_switch_dual_id', 'request', 'response', 'details', 'level'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function bot() {
        return $this->belongsTo('App\Bot');
    }

    public function smart_switch_dual() {
        return $this->belongsTo('App\SmartSwitchDual');
    }
}
