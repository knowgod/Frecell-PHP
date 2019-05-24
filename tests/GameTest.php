<?php
/**
 * @author    Arkadij Kuzhel <arkuzhel@gmail.com>
 * @created   11.05.18
 */
namespace Freecell\Tests;

/** @noinspection PhpFullyQualifiedNameUsageInspection */
/**
 * Class LcgTest
 *
 */
class GameTest extends \PHPUnit\Framework\TestCase
{
    public function getGameNumberTestData()
    {
        return [
            [
                500905,
                <<<'SET'
♠ J ♥ 4 ♠ 6 ♦ 8 ♦ 5 ♣ 5 ♠ 3 ♦ 3 
♥ 10♥ A ♣ Q ♦ 10♣ 2 ♥ 6 ♠ Q ♥ 7 
♥ Q ♠ 5 ♦ 2 ♣ A ♦ 9 ♣ 8 ♥ 3 ♣ 10
♠ 2 ♠ 4 ♦ 6 ♣ 3 ♦ J ♣ J ♦ K ♥ J 
♠ 10♥ 8 ♠ 9 ♦ 4 ♣ K ♣ 7 ♥ 2 ♦ A 
♥ K ♠ 7 ♦ 7 ♣ 9 ♦ Q ♠ A ♥ 5 ♥ 9 
♣ 6 ♠ K ♣ 4 ♠ 8 
SET
                ,
            ],
            [
                501083,
                <<<'SET'
♣ A ♣ 4 ♦ K ♠ K ♠ J ♠ 7 ♣ 3 ♥ A 
♦ A ♦ 6 ♣ 7 ♦ 2 ♣ 10♥ 3 ♥ K ♣ 6 
♥ 10♣ 2 ♦ 8 ♣ 5 ♣ 8 ♠ 6 ♥ J ♠ 5 
♦ J ♥ 6 ♣ K ♠ A ♦ 10♥ 9 ♠ Q ♠ 2 
♦ 7 ♦ Q ♠ 9 ♠ 3 ♦ 4 ♠ 4 ♥ 5 ♦ 5 
♥ Q ♥ 4 ♠ 8 ♣ 9 ♦ 3 ♥ 7 ♣ Q ♥ 8 
♣ J ♥ 2 ♠ 10♦ 9 
SET
                ,
            ],
        ];
    }

    /**
     * @dataProvider getGameNumberTestData
     *
     * @param int    $gameNumber
     * @param string $output
     */
    public function testRun(int $gameNumber, string $output)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        /** @noinspection PhpFullyQualifiedNameUsageInspection */
        $objGame = new \Freecell\Game();
        $objGame->run($gameNumber);
        $gameOutput = str_replace(['  ', "\n"], '', $objGame);
        $output     = str_replace("\n", '', $output);
        $this->assertEquals($output, $gameOutput);
    }
}
