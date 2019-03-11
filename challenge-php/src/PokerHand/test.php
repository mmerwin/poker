<?php
namespace PokerHand;
require "PokerHand.php";

$hand = new PokerHand('3s 3h 3c 7d 7s');

$faceCount = $hand->faceCount;
 $threeCount = $hand->findSets(3);
$twoCount = $hand->findSets(4);

echo $twoCount;

     



?>

