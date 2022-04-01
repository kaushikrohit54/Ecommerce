<?php
namespace Ecommerce\Creditlimit\Model\ResourceModel;

class Creditlimit extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('creditlimit', 'id');
    }
}
?>