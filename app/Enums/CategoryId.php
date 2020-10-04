<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryId extends Enum implements LocalizedEnum
{
    const PROGRAMMING =   0;
    const DESIGN =   1;
    const VIDEOPHOTO = 2;
    const ENTERPRENEURSHIPMANAGEMENT = 3;
    const MUSICS = 4;
    const HOBBY = 5;
    const TROUBLE = 6;
    const STUDY = 7;
    const OTHER = 8;
}
