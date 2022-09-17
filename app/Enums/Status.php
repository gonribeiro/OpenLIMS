<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static InTransit()
 * @method static static InHold()
 * @method static static Authorized()
 */
final class Status extends Enum
{
    const InTransit = 'In Transit';
    const InHold = 'In Hold';
    const Authorized = 'Authorized';
}
