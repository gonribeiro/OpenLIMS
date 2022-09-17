<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static µg()
 * @method static static ng()
 * @method static static mg()
 * @method static static g()
 * @method static static µL()
 * @method static static nL()
 * @method static static mL()
 * @method static static L()
 * @method static static un()
 * @method static static box()
 * @method static static kit()
 */
final class UnitMeasurement extends Enum
{
    const µg = 'µg';
    const ng = 'ng';
    const mg = 'mg';
    const g = 'g';
    const µL = 'µL';
    const nL = 'nL';
    const mL = 'mL';
    const L = 'L';
    const un = 'un';
    const box = 'box';
    const kit = 'kit';
}
