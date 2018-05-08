<?php
/**
 * @author    Arkadij Kuzhel <ak@360living.de>
 * @created   04.05.18
 */

namespace Freecell;

/**
 * Class CardRepresentation
 *
 */
class Card implements Api\GameObjectInterface
{
    const COLOUR_RED   = 1;
    const COLOUR_BLACK = 0;

    const SUIT_CLUB    = 0;
    const SUIT_DIAMOND = 1;
    const SUIT_HEART   = 2;
    const SUIT_SPADES  = 3;

    private static $suitFaces = [
        self::SUIT_CLUB    => "\u{2663}",
        self::SUIT_DIAMOND => "\u{2666}",
        self::SUIT_HEART   => "\u{2665}",
        self::SUIT_SPADES  => "\u{2660}",
    ];

    private static $cardFaces = [
        0  => ' A ',
        1  => ' 2 ',
        2  => ' 3 ',
        3  => ' 4 ',
        4  => ' 5 ',
        5  => ' 6 ',
        6  => ' 7 ',
        7  => ' 8 ',
        8  => ' 9 ',
        9  => ' 10',
        10 => ' J ',
        11 => ' Q ',
        12 => ' K ',
    ];

    protected $suit;

    protected $number;

    protected $value;

    protected $colour;

    public function __construct($cardNumber = null)
    {
        if (isset($cardNumber)) {
            $this->setNumber($cardNumber);
        }
    }

    public function setNumber($cardNumber)
    {
        $this->number = $cardNumber;
        $this->suit   = $suit = $cardNumber % 4;
        $this->value  = floor($cardNumber / 4);
        $this->colour = (self::SUIT_DIAMOND == $suit || self::SUIT_HEART == $suit) ? self::COLOUR_RED : self::COLOUR_BLACK;

    }

    /**
     * @return int
     */
    public function getSuit()
    {
        return $this->suit ?? false;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number ?? false;
    }

    /**
     * @return float|int
     */
    public function getValue()
    {
        return $this->value ?? false;
    }

    /**
     * @return int
     */
    public function getColour()
    {
        return $this->colour ?? false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->isInit())
            ? ''
            : self::$suitFaces[ $this->suit ] . self::$cardFaces[ $this->value ];
    }

    /**
     * @return bool
     */
    public function isInit(): bool
    {
        return empty($this->number) && 0 !== $this->number;
    }

}
