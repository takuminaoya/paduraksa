<?php

namespace App\Models;

use App\Modules\Whapify;
use Illuminate\Database\Eloquent\Model;

class WhatsappLaporan extends Model
{
    protected $guarded = ["id"];

    public function status(): string
    {
        $stats = Whapify::getSingleChat($this->whatsapp_id);
        return $stats['status'];
    }
}
