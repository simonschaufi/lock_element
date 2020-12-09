<?php
declare(strict_types=1);

namespace SimonSchaufi\LockElement\Form\Element;

use SimonSchaufi\LockElement\UserFunction\TCA;
use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DonationElement extends AbstractFormElement
{
    /**
     * @var TCA
     */
    protected $tcaUserFunction;

    public function __construct(NodeFactory $nodeFactory, array $data)
    {
        parent::__construct($nodeFactory, $data);

        $this->tcaUserFunction = GeneralUtility::makeInstance(TCA::class);
    }

    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     * @throws \Exception
     */
    public function render()
    {
        $result = $this->initializeResultArray();
        $result['html'] = $this->tcaUserFunction->donateField([], null);
        return $result;
    }
}
