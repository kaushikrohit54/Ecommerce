<?php
namespace Ecommerce\Creditlimit\Model;

class Creditlimit extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecommerce\Creditlimit\Model\ResourceModel\Creditlimit');
    }
}
?>