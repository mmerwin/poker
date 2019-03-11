<?php

namespace PokerHand;

class PokerHand
{
  
  private $hand;
  private $cards;
  private $suitCount;
  private $faceCount;
  
    public function __construct($hand)
    {
      $this->suitCount = array("s"=> 0, "d" => 0, "h"=> 0, "c" => 0);
      $this->faceCount = array("2"=>0, "3"=>0, "4"=>0, "5"=>0, "6"=>0, "7"=>0, "8"=>0, "9"=>0, "10"=>0, "J"=>0, "K"=>0, "Q"=>0, "A"=>0);
      $this->hand = $hand;
      
      //create array cards
      $cards = explode(" ",$hand);
      $newCard = array();
      foreach($cards as $line){
        $suit = strtolower(substr($line, -1));
        $face = strtoupper(substr($line, 0, -1));
        
        $newCard[] = array($face, $suit);
        
        //track occurance of each suit in the hand
        $this->suitCount[$suit] = ($this->suitCount[$suit] + 1);
        
        //track the occurance of each face in the hand
        $this->faceCount[$face] = ($this->faceCount[$face] + 1);
        
      } 
      
      $this->cards = $newCard;
    } //end constructor

    public function getRank()
    {
      $cards = $this->cards;
      if($this->checkRoyalFlush()){
        
        return "Royal Flush";
      }
      
      else if($this->checkStraightFlush()){
        
        return "Straight Flush";
      }
      else if($this->checkFourOfAKind()){
        
        return "Four of a Kind";
      } 
      else if($this->checkFullHouse()){
        
        return "Full House";
      } 
      else if($this->checkFlush()){
        
        return "Flush";
      }
      else if($this->checkStraight()){
        return "Straight";
      }
      else if($this->checkThreeOfAKind()){
        return "Three of a Kind";
      }
      else if($this->checkTwoPair()){
        return "Two Pair";
      }
      else if($this->checkOnePair()){
        return "One Pair";
      }
      else if($this->checkHighCard()){
        return "High Card";
      }
      
      
      
      else{return "Hand Unknown";}
      
       
    } //end function getRank
  
  public function checkRoyalFlush(){
    //a Royal Flush requires 10, J, K, Q, & A all in the same suit
    //check if Royal Flush is possible based on suit count
    $spades = $this->getSuitCount("s");
    $diamonds = $this->getSuitCount("d");
    $hearts = $this->getSuitCount("h");
    $clubs = $this->getSuitCount("c");
    
    $face_10 = $this->getFaceCount("10");
    $face_J = $this->getFaceCount("J");
    $face_K = $this->getFaceCount("K");
    $face_Q = $this->getFaceCount("Q");
    $face_A = $this->getFaceCount("A");
    if($spades === 5 || $diamonds === 5 || $hearts === 5 || $clubs === 5){
      //royal flush is possible
     
      //check the card faces match
      if($face_10 === 1 && $face_J === 1 && $face_K === 1 && $face_Q === 1 && $face_A === 1){
        return true; //confirmed to be Royal Flush
      } else{
        return false;
            }
      
    } else{
      return false;
    }
    
    
  } //end function checkRoyalFlush
  
  public function checkStraightFlush(){
    //a Straight Flush requires five cards in a row all in the same suit
    //check if Royal Flush is possible based on suit count
    $spades = $this->getSuitCount("s");
    $diamonds = $this->getSuitCount("d");
    $hearts = $this->getSuitCount("h");
    $clubs = $this->getSuitCount("c");
    
    if($spades === 5 || $diamonds === 5 || $hearts === 5 || $clubs === 5){
      //stright flush is possible
      //check if all the cards are available in order
      $cardsInOrder = $this->getCardValues();
      if($cardsInOrder[4] == ($cardsInOrder[0]+4)){
        return true;
      }
    } else{
      return false;
    }
    
    
  }//end function checkStraightFlush
  
  public function checkFourOfAKind(){
    // Four of a Kind requires the same number card in all four suits
    
    $setCount = $this->findSets(4);
    
    if($setCount == 1){
      return true;
    }
    else {
      return false;
    }
    
  }//end function checkFourOfAKind
  
  public function checkFullHouse(){
    // Full House requires 3 of the same numbers and 2 of the same different numbers
        
    
      //check for a set of 3 and 2
      $faceCount = $this->faceCount;
    $threeCount = $this->findSets(3);
    $twoCount = $this->findSets(2);
     
      
    if($threeCount == 1 && $twoCount == 1){
      return true;
    } else{
      return false;
    }
    
    
  }//end function checkFullHouse
  
  public function checkFlush(){
    // A Flush requires five cards (in any order) of the same suit
    $spades = $this->getSuitCount("s");
    $diamonds = $this->getSuitCount("d");
    $hearts = $this->getSuitCount("h");
    $clubs = $this->getSuitCount("c");
    
    if($spades === 5 || $diamonds === 5 || $hearts === 5 || $clubs === 5){
     return true; 
    } else{
      return false;
    }
    
  } //end function checkFlush
  
  
  
  public function checkStraight(){
    // A Straight equires five cards in a row. They can be in any suit
    
      //check if all the cards are available in order
      $cardsInOrder = $this->getCardValues();
      if($cardsInOrder[4] == ($cardsInOrder[0]+4)){
        return true;
      }
     else{
      return false;
    }
    
    
  }//end function checkStraight
  
  public function checkThreeOfAKind(){
    // 3 of a kind requires 3 cards with the same numerical value, no matter the suit
        
    
      //check for a set of 3
      $faceCount = $this->faceCount;
    $threeCount = $this->findSets(3);
     
      
    if($threeCount == 1){
      return true;
    } else{
      return false;
    }
    
  }//end function checkThreeOfAKind
  
    public function checkTwoPair(){
    // Two Pair requires two sets of the same card, ex: (2 threes and 2 jacks)
        
    
      //check for sets of 2
      $faceCount = $this->faceCount;
    $twoCount = $this->findSets(2);
     
      
    if($twoCount == 2){
      return true;
    } else{
      return false;
    }
    
  }//end function checkTwoPair
  
  public function checkOnePair(){
    // One Pair requires two of the same numeric-valued card
        
    
      //check for sets of 2
      $faceCount = $this->faceCount;
    $twoCount = $this->findSets(2);
     
      
    if($twoCount == 1){
      return true;
    } else{
      return false;
    }
    
  }//end function checkTwoPair
  
  public function checkHighCard(){
    $aceCount = $this->getFaceCount("A");
    if($aceCount != 0){
      return true;
    } 
    else{
      return false;
    }
  } //end function checkHighCard
  
  
  public function getCardsArray(){
    return $this->cards;
  } //end function getCardsArray
  
  public function getFaceCount($face){
    return $this->faceCount[$face];
  }//end function getFaceCount
  
  public function getSuitCount($suit){
    return $this->suitCount[$suit];
  }//end function getSuitCount
  
  public function getCardValues(){
      $cards = $this->cards;
      $cardValues = array();
    //convert cards to numeric values
      foreach($cards as $values){
        if($values[0] == 'J'){$cardValues[] = '11';}
        else if($values[0] == 'Q'){$cardValues[] = '12';}
        else if($values[0] == 'K'){$cardValues[] = '13';}
        else if($values[0] == 'A'){$cardValues[] = '14';}
        else {$cardValues[] = $values[0];}
        
      }
    sort($cardValues);
    return $cardValues;
  } //end function getCardValues
  
  public function findSets($quantity){
    $faceCount = $this->faceCount;
    $setCounts = 0;
      
      if($faceCount["J"] == $quantity || $faceCount["K"] == $quantity || $faceCount["Q"] == $quantity || $faceCount["A"] == $quantity){
        $setCounts++;
      }
    
      $counter = 2;
      while($counter <= 10){
        if ($faceCount[$counter] == $quantity){
         $setCounts++;
        }
        
        $counter++;
      }
      
    return $setCounts;
  } //end function findSets
  
} //end class PokerHand