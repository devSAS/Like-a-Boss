<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;

/**
 * This form is used to collect post data.
 */
class ProductForm extends Form

{
    /**
     * Scenario ('create' or 'update').
     * @var string
     */
    private $scenario;

    /**
     * Constructor.
     */
    public function __construct($scenario = 'create')
    {
        // Define form name
        parent::__construct('pproduct-form');
        $this->scenario = $scenario;

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->addElements();
        $this->addInputFilter();

    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {
        if ($this->scenario == 'create' || $this->scenario == 'update') {
            $this->add([
                'type' => 'text',
                'name' => 'name',
                'attributes' => [
                    'id' => 'name'
                ],
                'options' => [
                    'label' => 'Product Name',
                ],
            ]);
            $this->add([
                'type' => 'text',
                'name' => 'brand',
                'attributes' => [
                    'id' => 'brand'
                ],
                'options' => [
                    'label' => 'Product brand',
                ],
            ]);
            $this->add([
                'type' => 'text',
                'name' => 'status',
                'attributes' => [
                    'id' => 'status'
                ],
                'options' => [
                    'label' => 'Product Status',
                ],
            ]);
        }
        if ($this->scenario == 'create' || $this->scenario == 'updateInfo') {
            $this->add([
                'type' => 'text',
                'name' => 'color',
                'attributes' => [
                    'id' => 'color'
                ],
                'options' => [
                    'label' => 'Product Color',
                ],
            ]);
            $this->add([
                'type' => 'number',
                'name' => 'size',
                'attributes' => [
                    'id' => 'size'
                ],
                'options' => [
                    'label' => 'Product Size',
                ],
            ]);
            $this->add([
                'type' => 'number',
                'name' => 'price',
                'attributes' => [
                    'id' => 'price'
                ],
                'options' => [
                    'label' => 'Product Price',
                ],
            ]);
            $this->add([
                'type' => 'number',
                'name' => 'count',
                'attributes' => [
                    'id' => 'count'
                ],
                'options' => [
                    'label' => 'Product Count',
                ],
            ]);

            $this->add([
                'type' => 'file',
                'name' => 'file',
                'attributes' => [
                    'id' => 'file'
                ],
                'options' => [
                    'label' => 'Image file',
                ],
            ]);
        }


        // Add the submit button
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Create',
                'id' => 'submitbutton',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        if ($this->scenario == 'create' || $this->scenario == 'update') {
            $inputFilter->add([
                'name' => 'name',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 1024
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'brand',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 1024
                        ],
                    ],
                ],
            ]);
            $inputFilter->add([
                'name' => 'status',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 1024
                        ],
                    ],
                ],
            ]);
        }
        if ($this->scenario == 'create' || $this->scenario == 'updateInfo') {
            if ($this->scenario == 'create') {
                $inputFilter->add([
                    'name' => 'color',
                    'required' => true,
                    'filters' => [
                        ['name' => 'StringTrim'],
                        ['name' => 'StripTags'],
                        ['name' => 'StripNewlines'],
                    ],
                    'validators' => [
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 1,
                                'max' => 1024
                            ],
                        ],
                    ],
                ]);
                $inputFilter->add([
                    'name' => 'size',
                    'required' => true,
                    'filters' => [
                        ['name' => 'ToInt'],
                    ],
                    'validators' => [
                        [
                            'name' => 'Between',
                            'options' => [
                                'min' => 1,
                                'max' => 1024000
                            ],
                        ],
                    ],
                ]);
                $inputFilter->add([
                    'name' => 'price',
                    'required' => true,
                    'filters' => [
                        ['name' => 'ToInt'],
                    ],
                    'validators' => [
                        [
                            'name' => 'Between',
                            'options' => [
                                'min' => 1,
                                'max' => 1024000
                            ],
                        ],
                    ],
                ]);
                $inputFilter->add([
                    'name' => 'count',
                    'required' => true,
                    'filters' => [
                        ['name' => 'ToInt'],
                    ],
                    'validators' => [
                        [
                            'name' => 'Between',
                            'options' => [
                                'min' => 1,
                                'max' => 1024000
                            ],
                        ],
                    ],
                ]);
            }
            if ($this->scenario == 'create') {
                $inputFilter->add([
                    'type' => FileInput::class,
                    'name' => 'file',
                    'required' => true,
                    'validators' => [
                        ['name' => 'FileUploadFile'],
                        [
                            'name' => 'FileMimeType',
                            'options' => [
                                'mimeType' => ['image/jpeg', 'image/png']
                            ]
                        ],
                        ['name' => 'FileIsImage'],
                        [
                            'name' => 'FileImageSize',
                            'options' => [
                                'minWidth' => 128,
                                'minHeight' => 128,
                                'maxWidth' => 4096,
                                'maxHeight' => 4096
                            ]
                        ],
                    ],
                    'filters' => [
                        [
                            'name' => 'FileRenameUpload',
                            'options' => [
                                'target' => './public/img/upload',
                                'useUploadName' => true,
                                'useUploadExtension' => true,
                                'overwrite' => true,
                                'randomize' => false
                            ]
                        ]
                    ],
                ]);
            }
        }
    }
}

