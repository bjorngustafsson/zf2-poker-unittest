<?php
/**
 * Created by PhpStorm.
 * User: Bjorn
 * Date: 2014-12-12
 * Time: 13:34
 */
namespace PlayerTest\Model;

use Player\Model\Player;
use PHPUnit_Framework_TestCase;

class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function testPlayerInitialState()
    {
        $player = new Player();

        $this->assertNull(
            $player->PlayerName,
            '"artist" should initially be null'
        );
        $this->assertNull(
            $player->id,
            '"id" should initially be null'
        );
        $this->assertNull(
            $player->Hands,
            '"title" should initially be null'
        );
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $player = new Player();
        $data  = array('PlayerName' => 'some player',
            'id'     => 123,
            'Hands'  => 'some number of Hands');

        $player->exchangeArray($data);

        $this->assertSame(
            $data['Hands'],
            $player->Hands,
            '"Hands" was not set correctly'
        );
        $this->assertSame(
            $data['id'],
            $player->id,
            '"id" was not set correctly'
        );
        $this->assertSame(
            $data['PlayerName'],
            $player->PlayerName,
            '"PlayerName" was not set correctly'
        );
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $player = new Player();

        $player->exchangeArray(array('PlayerName' => 'some player',
            'id'     => 123,
            'Hands'  => 'some number of Hands'));

        $player->exchangeArray(array());

        $this->assertNull(
            $player->Hands, '"Hands" should have defaulted to null'
        );
        $this->assertNull(
            $player->id, '"id" should have defaulted to null'
        );
        $this->assertNull(
            $player->PlayerName, '"PlayerName" should have defaulted to null'
        );
    }

    public function testGetArrayCopyReturnsAnArrayWithPropertyValues()
    {
        $player = new Player();
        $data  = array('PlayerName' => 'some player',
            'id'     => 123,
            'Hands'  => 'some number of Hands');

        $player->exchangeArray($data);
        $copyArray = $player->getArrayCopy();

        $this->assertSame(
            $data['Hands'],
            $copyArray['Hands'],
            '"Hands" was not set correctly'
        );
        $this->assertSame(
            $data['id'],
            $copyArray['id'],
            '"id" was not set correctly'
        );
        $this->assertSame(
            $data['PlayerName'],
            $copyArray['PlayerName'],
            '"PlayerName" was not set correctly'
        );
    }

    public function testInputFiltersAreSetCorrectly()
    {
        $player = new Player();

        $inputFilter = $player->getInputFilter();

        $this->assertSame(7, $inputFilter->count());
        $this->assertTrue($inputFilter->has('Hands'));
        $this->assertTrue($inputFilter->has('id'));
        $this->assertTrue($inputFilter->has('PlayerName'));
    }
}