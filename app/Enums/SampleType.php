<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Blood()
 * @method static static Urine()
 */
final class SampleType extends Enum
{
    const Blood = 'Blood';
    const Urine = 'Urine';
}
