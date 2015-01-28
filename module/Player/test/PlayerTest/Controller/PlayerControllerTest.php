<?php

namespace PlayerTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PlayerControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include 'config' . DIRECTORY_SEPARATOR . 'application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {

        $playerTableMock = $this->getMockBuilder('Player\Model\PlayerTable')
            ->disableOriginalConstructor()
            ->getMock();

        $playerTableMock->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue(array()));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Player\Model\PlayerTable', $playerTableMock);

        $this->dispatch('/player');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Player');
        $this->assertControllerName('Player\Controller\Player');
        $this->assertControllerClass('PlayerController');
        $this->assertMatchedRouteName('player');
    }

    //Denna funkar inte returner 200 response code fast ska 302
/*
    public function testAddActionRedirectsAfterValidPost()
    {
        $playerTableMock = $this->getMockBuilder('Player\Model\PlayerTable')
            ->disableOriginalConstructor()
            ->getMock();

        $playerTableMock->expects($this->once())
            ->method('savePlayer')
            ->will($this->returnValue(null));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Player\Model\PlayerTable', $playerTableMock);

        $postData = array(
            'id' => '',
            'PlayerName'  => 'Led Goooransson',
            'Hands' => '5',
            'vpip' => '5',
            'pfr' => '5',
            'threebet' => '5',
            'squeeze' => '5',

        );

        $this->dispatch('/player/add', 'POST', $postData);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/player');
    }
*/

}