<?php

declare(strict_types=1);

namespace K2gl\PHPUnitFluentAssertions\Tests\Fixtures;

enum Status: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
}
