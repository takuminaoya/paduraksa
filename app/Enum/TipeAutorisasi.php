<?php

namespace App\Enum;

enum TipeAutorisasi: string
{
    case VERIFIKASI = 'VERIFIKASI';
    case TINDAK_LANJUT = 'TINDAK_LANJUT';
    case BATAL = 'BATAL';
    case SELESAI = 'SELESAI';
}
