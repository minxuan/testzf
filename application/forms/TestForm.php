<?php
class Application_Form_TestForm extends Zend_Form
{
    public function init()
    {
        parent::init();

        // TODO: create a class for select box title for use easily in others path of this project
        // get title list from database
        $titleTab = array();
        $em = Zend_Registry::get('em');
        $titles = $em->getRepository('\Entities\Title')->getList();
        foreach ($titles as $title) {
            $titleTab[$title->id] = $title->label;
        }

        // user id, field hidden
        $this->addElement(
            'hidden', 'id'
        )
        ->getElement('id')
        ->removeDecorator('Label')
        ->removeDecorator('HtmlTag');

        // element for name
        $this->addElement(
            'text',
            'name',
            array(
                'label'      => 'name',
                'required'   => true,
                'filters'    => array('StringTrim'),
                'validators' => array(new Zend_Validate_StringLength(2, 50)),
            )
        );

        // select box title
        $this->addElement(
            'select',
            'idTitle',
            array(
                'label'        => 'Title',
                'filters'      => array('StringTrim'),
                'multiOptions' => $titleTab,
                'validators'   => array(
                    array(new Application_Validate_Title())
                )
            )
        );

        // element for email
        $this->addElement(
            'text',
            'email',
            array(
                'label'      => 'Email',
                'filters'    => array('StringTrim'),
                'required'   => false,
                'size'       => 70,
                'maxlength'  => 100,
                'validators' => array(
                    array('EmailAddress'),
                    array('StringLength', true, array(0, 100))
                )
            )
        );

        // nothing to say...
        $this->addElement(
            'submit',
            'valid',
            array(
                'label' => 'Valid'
            )
        );

        // make label in span, and element in div
        $elements = $this->getElements();
        foreach ($elements as $elm) {
            if ($elm->getName() != 'id' && $elm->getName() != 'valid') {
                $elm->getDecorator('label')
                    ->setOptions(
                        array(
                        	'tag' => 'span'
                        )
                    );
                $elm->getDecorator('HtmlTag')
                    ->setOptions(
                        array(
                        	'tag' => 'div'
                        )
                    );
            }
        }
    }
}
