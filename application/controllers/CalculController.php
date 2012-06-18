<?php

class CalculController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // get entity manager
        $em = Zend_Registry::get('em');
        // KLUDGE: use always the first result in table 'forTest'
        $forTest = $em->getRepository('\Entities\ForTest')->find('1');
        // field X = value of field Z in DB
        $fieldX = $forTest->fieldZ;
        // defaut value of field Y = 0
        $ySession = new Zend_Session_Namespace('fieldY');
        $fieldY = isset($ySession->fieldY) ? $ySession->fieldY : 0;
        // KLUDGE: always the N°1, Mr. Test, :-)
        $user = $em->getRepository('\Entities\User')->find('1');

        $form = new Application_Form_TestForm();

        // in case submit
        if ($this->_request->isPost()) {
            $post = $this->_request->getPost();
            if ($form->isValid($post)) {
                try {
                    // save post values
                    $user->fromArray($post);
                    $em->persist($user);
                    $forTest->fieldZ = $this->_calculZ($fieldX, $fieldY);
                    $em->persist($forTest);
                    $em->flush();
                    // update field X and Y
                    $fieldY = $ySession->fieldY = $fieldX;
                    $fieldX = $forTest->fieldZ;
                } catch (Exception $e) {
                    // usually, problem of connection DB
                    // TOOD: echo message
                }
            }
        } else {
            $post = $user->toArray();
        }
        // values for view
        $this->view->fieldX = $fieldX;
        $this->view->fieldY = $fieldY;
        $this->view->fieldZ = $this->_calculZ($fieldX, $fieldY);
        $form->populate($post);
        $this->view->form = $form;
    }

    private function _calculZ($fieldX, $fieldY)
    {
        return $fieldX * (2 + $fieldY);
    }
}
