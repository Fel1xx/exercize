<?php

declare(strict_types=1);

namespace Nikolay\EntryChallengeTest;

use Nikolay\EntryChallenge\PreorderCalculator;
use PHPUnit\Framework\TestCase;

class PreorderCalculatorTest extends TestCase
{
    private PreorderCalculator $calculator;

    public static function dataProviderTestCalculate(): iterable
    {
        yield [0, 1];
        yield [1, 1];
        yield [2, 4];
        yield [3, 29];
        yield [4, 355];
//        yield [5, 6942];
//        yield [6, 209527];
    }

    /**
     * @param $size
     * @param $preordersCount
     * @return void
     * @dataProvider dataProviderTestCalculate
     */
    public function testCalculate($size, $preordersCount)
    {
        static::assertEquals($preordersCount, $this->calculator->calculate($size));
    }

    protected function setUp(): void
    {
        $this->calculator = new PreorderCalculator();
    }


}
