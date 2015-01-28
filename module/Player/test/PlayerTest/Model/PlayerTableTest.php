<?php
namespace PlayerTest\Model;

use Player\Model\PlayerTable;
use Player\Model\Player;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class PlayerTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllPlayers()
    {
        $resultSet = new ResultSet();
        $mockTableGateway = $this->getMock(
            'Zend\Db\TableGateway\TableGateway',
            array('select'),
            array(),
            '',
            false
        );
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with()
            ->will($this->returnValue($resultSet));

        $playerTable = new PlayerTable($mockTableGateway);

        $this->assertSame($resultSet, $playerTable->fetchAll());
    }

    public function testCanRetrieveAPlayerByItsId()
    {
        $player = new Player();
        $player->exchangeArray(array('id'     => 123,
            'PlayerName' => 'some player',
            'Hands'  => '123'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Player());
        $resultSet->initialize(array($player));

        $mockTableGateway = $this->getMock(
            'Zend\Db\TableGateway\TableGateway',
            array('select'),
            array(),
            '',
            false
        );
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $playerTable = new PlayerTable($mockTableGateway);

        $this->assertSame($player, $playerTable->getPlayer(123));
    }
    //more tests

}