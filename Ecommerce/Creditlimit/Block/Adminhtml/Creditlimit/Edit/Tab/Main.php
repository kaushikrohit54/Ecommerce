<?php

namespace Ecommerce\Creditlimit\Block\Adminhtml\Creditlimit\Edit\Tab;

/**
 * Creditlimit edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Ecommerce\Creditlimit\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Ecommerce\Creditlimit\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Ecommerce\Creditlimit\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('creditlimit');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

		
        $fieldset->addField(
            'customer_name',
            'text',
            [
                'name' => 'customer_name',
                'label' => __('Customer Name'),
                'title' => __('Customer Name'),
				'required' => true,
                'values' => '',
                'disabled' => $isElementDisabled
            ]
        );
					

        $fieldset->addField(
            'trans_type',
            'select',
            [
                'label' => __('Transaction Type'),
                'title' => __('Transaction Type'),
                'name' => 'trans_type',
				'required' => true,
                'options' => \Ecommerce\Creditlimit\Block\Adminhtml\Creditlimit\Grid::getOptionArray2(),
                'disabled' => $isElementDisabled
            ]
        );

						
        $fieldset->addField(
            'credit_amt',
            'text',
            [
                'name' => 'credit_amt',
                'label' => __('Credit Amount'),
                'title' => __('Credit Amount'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'debit_amt',
            'text',
            [
                'name' => 'debit_amt',
                'label' => __('Debit Amount'),
                'title' => __('Debit Amount'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'balance_amt',
            'text',
            [
                'name' => 'balance_amt',
                'label' => __('Balance Amount'),
                'title' => __('Balance Amount'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'trans_date',
            'date',
            [
                'name' => 'trans_date',
                'label' => __('Transaction Date'),
                'title' => __('Transaction Date'),
				'format' => 'yy-mm-dd',
                'input_format' => 'yy-mm-dd',
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'remarks',
            'textarea',
            [
                'name' => 'remarks',
                'label' => __('Remarks'),
                'title' => __('Remarks'),
				
                'disabled' => $isElementDisabled
            ]
        );
					

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
