<?php
namespace Ecommerce\Creditlimit\Block\Adminhtml\Creditlimit;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Ecommerce\Creditlimit\Model\creditlimitFactory
     */
    protected $_creditlimitFactory;

    /**
     * @var \Ecommerce\Creditlimit\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Ecommerce\Creditlimit\Model\creditlimitFactory $creditlimitFactory
     * @param \Ecommerce\Creditlimit\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Ecommerce\Creditlimit\Model\CreditlimitFactory $CreditlimitFactory,
        \Ecommerce\Creditlimit\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_creditlimitFactory = $CreditlimitFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_creditlimitFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'customer_name',
					[
						'header' => __('Customer Name'),
						'index' => 'customer_name',
					]
				);
				

						$this->addColumn(
							'trans_type',
							[
								'header' => __('Transaction Type'),
								'index' => 'trans_type',
								'type' => 'options',
								'options' => \Ecommerce\Creditlimit\Block\Adminhtml\Creditlimit\Grid::getOptionArray2()
							]
						);

						
				$this->addColumn(
					'credit_amt',
					[
						'header' => __('Credit Amount'),
						'index' => 'credit_amt',
					]
				);
				
				$this->addColumn(
					'debit_amt',
					[
						'header' => __('Debit Amount'),
						'index' => 'debit_amt',
					]
				);
				
				$this->addColumn(
					'balance_amt',
					[
						'header' => __('Balance Amount'),
						'index' => 'balance_amt',
					]
				);
				
				$this->addColumn(
					'trans_date',
					[
						'header' => __('Transaction Date'),
						'index' => 'trans_date',
					]
				);
				


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('creditlimit/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('creditlimit/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Ecommerce_Creditlimit::creditlimit/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('creditlimit');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('creditlimit/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('creditlimit/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('creditlimit/*/index', ['_current' => true]);
    }

    /**
     * @param \Ecommerce\Creditlimit\Model\creditlimit|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'creditlimit/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray2()
		{
            $data_array=array(); 
			$data_array[0]='Credit';
			$data_array[1]='Debit';
            return($data_array);
		}
		static public function getValueArray2()
		{
            $data_array=array();
			foreach(\Ecommerce\Creditlimit\Block\Adminhtml\Creditlimit\Grid::getOptionArray2() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);
			}
            return($data_array);

		}
		

}