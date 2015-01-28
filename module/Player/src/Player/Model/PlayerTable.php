<?php
namespace Player\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PlayerTable
{
    protected $tableGateway;


    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }


    public function fetchAll($paginated=false)
    {

        if ($paginated) {
            // create a new Select object for the table Player
            $select = new Select('bearstats');
            $select->order('Hands DESC');
            // create a new result set based on the Player entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Player());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
            // our configured select object
                $select,
                // the adapter to run it against
                $this->tableGateway->getAdapter(),
                // the result set to hydrate
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;

      /*
       $resultSet = $this->tableGateway->select();
      return $resultSet;
      */
    }


    public function getPlayer($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function savePlayer(Player $player)
    {
        $data = array(
            'PlayerName' => $player->PlayerName,
            'Hands'  => $player->Hands,
            'vpip'  => $player->vpip,
            'pfr'  => $player->pfr,
            'threebet'  => $player->threebet,
            'squeeze'  => $player->squeeze,

        );

        $id = (int) $player->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPlayer($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Player id does not exist');
            }
        }
    }

    public function deletePlayer($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}