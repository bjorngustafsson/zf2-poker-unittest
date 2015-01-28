<?php
namespace Player\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Player\Model\Player;
use Player\Form\PlayerForm;

class PlayerController extends AbstractActionController
{
    protected $playerTable;


    public function indexAction()
    {
         return new ViewModel(array(
            'players' => $this->getPlayerTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new PlayerForm();
        $form->get('submit')->setValue('Lägg till');   //Sets the text (label) on the submit button to "xxx"

        $request = $this->getRequest();
        if ($request->isPost()) {
            $player = new Player();
            $form->setInputFilter($player->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $player->exchangeArray($form->getData());
                $this->getPlayerTable()->savePlayer($player);

                // Redirect to list of player
                return $this->redirect()->toRoute('player');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('player', array(
                'action' => 'add'
            ));
        }

        // Get the Player with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $player = $this->getPlayerTable()->getPlayer($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('player', array(
                'action' => 'index'
            ));
        }

        $form  = new PlayerForm();
        $form->bind($player);
        $form->get('submit')->setAttribute('value', 'Spara');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($player->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPlayerTable()->savePlayer($player);

                // Redirect to list of player
                return $this->redirect()->toRoute('player');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('player');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Nej');

            if ($del == 'Ja') {
                $id = (int) $request->getPost('id');
                $this->getPlayerTable()->deletePlayer($id);
            }

            // Redirect to list of player
            return $this->redirect()->toRoute('player');
        }

        return array(
            'id'    => $id,
            'player' => $this->getPlayerTable()->getPlayer($id)
        );
    }

    public function getPlayerTable()
    {
        if (!$this->playerTable) {
            $sm = $this->getServiceLocator();
            $this->playerTable = $sm->get('Player\Model\PlayerTable');
        }
        return $this->playerTable;
    }

}