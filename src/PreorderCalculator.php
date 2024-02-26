<?php

namespace Nikolay\EntryChallenge;

class PreorderCalculator
{
    /**
     * @param int $setSize Size of a set
     * @return int
     */
    public function calculate(int $setSize): int
    {
        $set = $this->fillSet($setSize);
        $pairSet = $this->getCartesianProduct($set);
        $subsets = $this->getSubsets(iterator_to_array($pairSet)); // it's memory-safe to convert to array here as the size is relatively small

        $preorders = 0;

        foreach ($subsets as $subset) {
            if (
                // testing of reflectiveness is faster, running it first improves overall performance about x2
                // despite it makes an extra iteration over a subset
//                $this->isPreorder()
                $this->isReflective($subset, $set) && $this->isTransitive($subset)
            ) {
                $preorders++;
            }
        }

        return $preorders;
    }

    private function fillSet(int $size): array
    {
        if ($size == 0) {
            return [[]];
        }

        return range(1, $size);
    }

    private function getCartesianProduct(array $set): iterable
    {
        foreach ($set as $a) {
            foreach ($set as $b) {
                yield [$a, $b];
            }
        }
    }

    private function getSubsets(array $set): iterable
    {
        if (empty($set)) {
            return [[]];
        }

        for ($i = 1 << count($set); --$i;) {
            $out = [];

            foreach ($set as $j => $u) {
                if ($i >> $j & 1) {
                    $out[] = $u;
                }
            }
            yield $out;
        }
    }

    private function isReflective(array $set, $initialSet): bool {
        $reflectiveCount = 0;
        foreach ($set as $item) {
            if ($item[0] == $item[1]) {
                $reflectiveCount++;
            }
        }
        return count($initialSet) == $reflectiveCount;
    }

    private function isTransitive(array $set): bool
    {

        foreach ($set as $element) {
            list($a, $b) = $element;
            foreach ($set as $element2) {
                list ($c, $d) = $element2;
                if ($b == $c && !in_array([$a, $d], $set)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param array $set
     * @param $initialSet
     * @return bool
     * @deprecated
     */
    private function isPreorder(array $set, $initialSet): bool
    {
        $reflectiveElements = 0;

        foreach ($set as $element) {
            list($a, $b) = $element;
            if ($a == $b) {
                $reflectiveElements++;
            }
            foreach ($set as $element2) {
                list ($c, $d) = $element2;
                if ($b == $c && !in_array([$a, $d], $set)) {
                    return false;
                }
            }
        }

        return $reflectiveElements == count($initialSet);
    }


}










