<?php
namespace PokerHand;

use PHPUnit\Framework\TestCase;

class PokerHandTest extends TestCase
{
    /**
     * @test
     */
    public function itCanRankARoyalFlush()
    {
        $hand = new PokerHand('As Ks Qs Js 10s');
        $this->assertEquals('Royal Flush', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankAStraightFlush()
    {
        $hand = new PokerHand('5h 6h 7h 8h 9h');
        $this->assertEquals('Straight Flush', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankFourOfAKindSetOne()
    {
        $hand = new PokerHand('Qh Qs Qc Qd Js');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankFourOfAKindSetTwo()
    {
        $hand = new PokerHand('3h 3s 3c 3d Js');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankAFullHouseSetOne()
    {
        $hand = new PokerHand('10h 10c 10d Js Jd');
        $this->assertEquals('Full House', $hand->getRank());
    }
    /**
     * @test
     */
    public function itCanRankAFullHouseSetTwo()
    {
        $hand = new PokerHand('2h 2c 2d 9c 9d');
        $this->assertEquals('Full House', $hand->getRank());
    }
  
  
    /**
     * @test
     */
    public function itCanRankAFlush()
    {
        $hand = new PokerHand('Kh Qh 6h 2h 9h');
        $this->assertEquals('Flush', $hand->getRank());
    }
  
  
    /**
     * @test
     */
    public function itCanRankAStraightSetOne()
    {
        $hand = new PokerHand('7h 8c 9d 10s Jh');
        $this->assertEquals('Straight', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankAStraightSetTwo()
    {
        $hand = new PokerHand('7h 9c Jd 10s 8h');
        $this->assertEquals('Straight', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankAStraightSetThree()
    {
        $hand = new PokerHand('3h 4c 5d 6s 7h');
        $this->assertEquals('Straight', $hand->getRank());
    }
  
    /**
     * @test
     */
    public function itCanRankThreeOfAKind()
    {
        $hand = new PokerHand('7h 7c 7d 10s Kh');
        $this->assertEquals('Three of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAPair()
    {
        $hand = new PokerHand('Ah As 10c 7d 6s');
        $this->assertEquals('One Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankTwoPair()
    {
        $hand = new PokerHand('Kh Kc 3s 3h 2d');
        $this->assertEquals('Two Pair', $hand->getRank());
    }
    /**
     * @test
     */
    public function itCanRankAHighCard()
    {
        $hand = new PokerHand('2h 9c Jd As 8h');
        $this->assertEquals('High Card', $hand->getRank());
    }

    
  
    


    // TODO: More tests go here
}