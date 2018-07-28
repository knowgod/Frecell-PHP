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
    const NOT_SET = '';

    const COLOUR_RED   = 1;
    const COLOUR_BLACK = 0;

    const SUIT_CLUB    = 0;
    const SUIT_DIAMOND = 1;
    const SUIT_HEART   = 2;
    const SUIT_SPADES  = 3;

    private $suitFaces = [
        self::SUIT_CLUB    => "\u{2663}",
        self::SUIT_DIAMOND => "\u{2666}",
        self::SUIT_HEART   => "\u{2665}",
        self::SUIT_SPADES  => "\u{2660}",
    ];

    private $cardFaces = [
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

    /**
     * @var int
     */
    protected $suit;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var int
     */
    protected $value;

    /**
     * @var int
     */
    protected $colour;

    /**
     * Card constructor.
     *
     * @param int|null $cardNumber
     */
    public function __construct(int $cardNumber = null)
    {
        if (isset($cardNumber)) {
            $this->setNumber($cardNumber);
        }
    }

    /**
     * @param int $cardNumber
     */
    public function setNumber(int $cardNumber)
    {
        $this->number = $cardNumber;
        $this->suit   = $suit = $cardNumber % 4;
        $this->value  = floor($cardNumber / 4);
        $this->colour = (self::SUIT_DIAMOND == $suit || self::SUIT_HEART == $suit)
            ? self::COLOUR_RED
            : self::COLOUR_BLACK;
    }

    /**
     * @return int|bool
     */
    public function getSuit()
    {
        return $this->suit ?? false;
    }

    /**
     * @return int|bool
     */
    public function getNumber()
    {
        return $this->number ?? false;
    }

    /**
     * @return int|bool
     */
    public function getValue()
    {
        return $this->value ?? false;
    }

    /**
     * @return int:bool
     */
    public function getColour()
    {
        return $this->colour ?? false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return ($this->isInit())
            ? self::NOT_SET
            : $this->suitFaces[ $this->suit ] . $this->cardFaces[ $this->value ];
    }

    /**
     * @return bool
     */
    public function isInit(): bool
    {
        return empty($this->number) && 0 !== $this->number;
    }

}
