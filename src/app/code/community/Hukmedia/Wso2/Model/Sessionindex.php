<?php

class Hukmedia_Wso2_Model_Sessionindex extends Mage_Core_Model_Abstract
{

    protected function _construct() {
        $this->_init('hukmedia_wso2/sessionindex');
    }

    /**
     * Get session informations by WSO2 SessionIndex
     * @param string $sessionIndex
     * @return Mage_Core_Model_Abstract
     */
    public function loadBySessionIndex($sessionIndex = null) {
        return $this->load($sessionIndex, 'wso_session_index');
    }

    /**
     * Get session informations by customer email
     * @param string $email
     * @return Mage_Core_Model_Abstract
     */
    public function loadByEmail($email = null) {
        return $this->load($email, 'magento_user_name');
    }

    /**
     * Get session informations by customer id
     * @param string $id
     * @return Mage_Core_Model_Abstract
     */
    public function loadByCustomerId($id = null) {
        return $this->load($id, 'magento_customer_id');
    }

    public function saveSessionData(Mage_Customer_Model_Session $session, Mage_Customer_Model_Customer $customer, $sessionIndex) {
        $this->loadByCustomerId($customer->getId());
        if(!$this->getId()) {
            $this->setMagentoSessionId($session->getEncryptedSessionId());
            $this->setMagentoUserName($customer->getEmail());
            $this->setMagentoCustomerId($customer->getId());
            $this->setWsoSessionIndex($sessionIndex);
        } else {
            $this->setMagentoSessionId($session->getEncryptedSessionId());
            $this->setWsoSessionIndex($sessionIndex);
        }
        $this->save();
    }
}