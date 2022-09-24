<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Entry()
 * @method static static Exit()
 * @method static static Relocation()
 * @method static static Received()
 */
final class CustodyType extends Enum
{
    const Entry = 'Entry';
    const Exit = 'Exit';
    const Relocation = 'Relocation';
    const Received = 'Received';
}
