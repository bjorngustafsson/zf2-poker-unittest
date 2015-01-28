<?php
namespace Player\Form;

use Zend\Form\Form;
use Zend\Captcha;


 class PlayerForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         //parent::__construct('players');
         parent::__construct('player'); //First, we set the name of the form as we call the parent’s constructor.

         //we create four form elements
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'PlayerName',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Spelare',
             ),
         ));

         $this->add(array(
             'name' => 'Hands',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Händer',
             ),
         ));

                 $this->add(array(
             'name' => 'vpip',
             'type' => 'Text',
             'options' => array(
                 'label' => 'VPIP',
             ),
         ));

                      $this->add(array(
             'name' => 'pfr',
             'type' => 'Text',
             'options' => array(
                 'label' => 'PFR',
             ),
         ));

                      $this->add(array(
             'name' => 'threebet',
             'type' => 'Text',
             'options' => array(
                 'label' => '3bet',
             ),
         ));

                      $this->add(array(
             'name' => 'squeeze',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Squeeze',
             ),
         ));

         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-success' ,

             ),
         ));

              $this->add(array(
             'name' => 'captcha',
             'type' => 'Zend\Form\Element\Captcha',
             'options' => array(
                 'label' => 'Captcha Verification : Enter text ',
                 'captcha' => new Captcha\Figlet (),

             ),
         ));
     }
 }


