<?php
class Application_Validate_Title extends Zend_Validate_Abstract
{
    const INVALID = 'invalid';

    protected $_messageTemplates = array(
        self::INVALID => '2 is not allowed value',
    );

    public function isValid($value)
    {
        $this->_setValue($value);

        // don't allow 2 as value of title
        if ($value == 2) {
            $this->_error(self::INVALID);
            return false;
        } else {
            return true;
        }
    }
}
