<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Drawer()
 * @method static static refrigerator()
 */
final class StorageType extends Enum
{
    const Drawer = 'Drawer';
    const Refrigerator = 'Refrigerator';
}
