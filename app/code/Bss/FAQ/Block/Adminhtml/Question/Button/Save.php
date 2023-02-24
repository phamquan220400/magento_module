<?php

namespace Bss\FAQ\Block\Adminhtml\Question\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

class Save extends Generic implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label'=>__('Save'),
            'class'=>'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_new_question.faq_new_question',
                                'actionName' => 'save',
                                'params' => [
                                    false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'option' => $this->getOptions(),
        ];
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $options[] = [
            'id_hard' => 'save_and_new',
            'label' => __('Save & New'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_new_question.faq_new_question',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'add',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $options[] = [
            'id_hard' => 'save_and_close',
            'label' => __('Save & Close'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_new_question.faq_new_question',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'close',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $options;
    }
}
