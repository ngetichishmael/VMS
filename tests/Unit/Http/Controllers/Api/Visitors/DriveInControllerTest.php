<?php

namespace Http\Controllers\Api\Visitors;

use App\Http\Controllers\Api\Visitors\DriveInController;
use App\Models\Visitor;
use PHPUnit\Framework\TestCase;

class DriveInControllerTest extends TestCase
{

    public function testShow(Visitor $visitor)
    {
return $visitor;
    }
}
