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
class Card implements Api\GameObjectInterface, Api\Object\CardInterface
{
    const NOT_SET = '';

    /**
     * @var int|bool
     */
    protected $suit = false;

    /**
     * @var int|bool
     */
    protected $number = false;

    /**
     * @var int|bool
     */
    protected $value = false;

    /**
     * @var int|bool
     */
    protected $colour = false;

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
        return $this->suit;
    }

    /**
     * @return int|bool
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int|bool
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int|bool
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->isInit()
            ? self::FACE_SUIT[$this->suit] . self::FACE_CARD[$this->value]
            : self::NOT_SET;
    }

    /**
     * @return bool
     */
    public function isInit(): bool
    {
        return false !== $this->number;
    }

}
