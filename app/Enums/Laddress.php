<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Laddress extends Enum implements LocalizedEnum
{
    const TOKYO =   0;
    const SAITAMA =   1;
    const CHIBA = 2;
    const KANAGAWA = 3;
    const IBARAKI = 4;
    const GUNMA = 5;
    const TOCHIGI = 6;
}
