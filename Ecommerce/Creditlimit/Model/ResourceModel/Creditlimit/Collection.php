<?php

namespace Ecommerce\Creditlimit\Model\ResourceModel\Creditlimit;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecommerce\Creditlimit\Model\Creditlimit', 'Ecommerce\Creditlimit\Model\ResourceModel\Creditlimit');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>