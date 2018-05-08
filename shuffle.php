<?php
/**
 * @author    Arkadij Kuzhel <ak@360living.de>
 * @created   04.05.18
 */

namespace Freecell;

require_once 'lib/linear-congruential-generator.php';
require_once 'Api/GameObjectInterface.php';
require_once 'Api/FactoryInterface.php';
require_once 'Card.php';
require_once 'CardFactory.php';
require_once 'Deck.php';
require_once 'Game.php';

$objGame = new Game();
$objGame->run(500828);
echo $objGame;
