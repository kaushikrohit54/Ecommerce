<?php

namespace Ecommerce\Creditlimit\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class CustomerSetup extends EavSetup {

	protected $eavConfig;

	public function __construct(
		ModuleDataSetupInterface $setup,
		Context $context,
		CacheInterface $cache,
		CollectionFactory $attrGroupCollectionFactory,
		Config $eavConfig
		) {
		$this -> eavConfig = $eavConfig;
		parent :: __construct($setup, $context, $cache, $attrGroupCollectionFactory);
	}

	public function installAttributes($customerSetup) {
		$this -> installCustomerAttributes($customerSetup);
		$this -> installCustomerAddressAttributes($customerSetup);
	}

	public function installCustomerAttributes($customerSetup) {
		
		$attribute_code = 'credit_balance';			

		$customerSetup -> addAttribute(\Magento\Customer\Model\Customer::ENTITY,
			'credit_balance',
			[
			'label' => 'Credit Balance',
			'system' => 0,
			'position' => 100,
            'sort_order' =>100,
            'visible' =>  false,
			'note' => '',
				

                        'type' => 'varchar',
                        'input' => 'text',
			
			]
			);

		$customerSetup->addAttributeToSet(
            CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
            CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
            null,
            $attribute_code);
			
		$customerSetup -> getEavConfig() -> getAttribute('customer', 'credit_balance')->setData('is_user_defined',1)->setData('is_required',0)->setData('default_value','')->setData('used_in_forms', ['']) -> save();

				
	}

	public function installCustomerAddressAttributes($customerSetup) {
			
	}

	public function getEavConfig() {
		return $this -> eavConfig;
	}
} 