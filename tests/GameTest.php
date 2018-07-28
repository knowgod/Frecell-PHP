<?php
/**
 * @author    Arkadij Kuzhel <arkuzhel@gmail.com>
 * @created   11.05.18
 */
namespace Frecell\Tests;

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
        $objGame = new \Freecell\Game();
        $objGame->run($gameNumber);
        $gameOutput = str_replace(['  ', "\n"], '', $objGame);
        $output = str_replace("\n", '', $output);
        $this->assertEquals($output, $gameOutput);
    }
}
