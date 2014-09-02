<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-7-31
 * Time: 上午10:20
 */

namespace Application\Form\InputFilter;


use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use DHR\Form\Validator;
class Product implements InputFilterAwareInterface{
    // Add content to these methods:
    protected $inputFilter = null;
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();


            //create element input
            $productName = $factory->createInput(array(
               'name'=>"ProductName",
                'required'=>true,
                "allow_empty"=>false
            ));

            $statusInput = $factory->createInput(array(
                'name'     => 'Status',
                'required' => false,
                'allow_empty'=>true

            ));

            $ecosystemFocus = $factory->createInput(array(
                'name'     => 'Ecosystem',
                'required' => false,
                'allow_empty'=>true

            ));



            $ProductCategory = $factory->createInput(array(
                'name'     => 'ProductCategory',
                'required' => false,
                'allow_empty'=>true

            ));


            $Connectivity = $factory->createInput(array(
                'name'     => 'Connectivity',
                'required' => false,
                'allow_empty'=>true

            ));

            $OSCompatibility = $factory->createInput(array(
                'name'     => 'OSCompatibility',
                'required' => false,
                'allow_empty'=>true

            ));

            $PowerSupply = $factory->createInput(array(
                'name'     => 'PowerSupply',
                'required' => false,
                'allow_empty'=>true

            ));

            $productCompatibility = $factory->createInput(array(
                'name'     => 'productCompatibility',
                'required' => false,
                'allow_empty'=>true

            ));

            $productWeight = $factory->createInput(array(
                'name'     => 'Weight',
                'required' => false,
                'allow_empty'=>true

            ));

            $regionalAvailability = $factory->createInput(array(
                'name'     => 'RegionalAvailability',
                'required' => false,
                'allow_empty'=>true
            ));

            $color = $factory->createInput(array(
                'name'     => 'Color',
                'required' => false,
                'allow_empty'=>true
            ));

            //create input filter
            //product basci
            $ProductBasicInputFilter = $factory->createInputFilter(array(
                "ProductName"=>$productName,
                "Ecosystem"=>$ecosystemFocus,
                "Status"=>$statusInput,
                "ProductCategory"=>$ProductCategory,

            ));
            //dimensions
            $ProductDimensionsInputFilter = $factory->createInputFilter(array(
                "Weight"=>$productWeight
            ));

            //connectivity
            $ProductConnectivityInputFilter = $factory->createInputFilter(array(
                "Connectivity"=>$Connectivity,
            ));

            //power supply
            $ProductPowerSupplyInputFilter = $factory->createInputFilter(array(
                "PowerSupply"=>$PowerSupply,
            ));

            //feature
            $ProductFeatureInputFilter = $factory->createInputFilter(array(
                "productCompatibility"=>$productCompatibility,
                "PowerSupply"=>$PowerSupply,
                "Connectivity"=>$Connectivity,
                "OSCompatibility"=>$OSCompatibility,
                "Weight"=>$productWeight,
                "Color"=>$color
            ));

            //software
            $ProductSoftwareInputFilter = $factory->createInputFilter(array(
                "OSCompatibility"=>$OSCompatibility,
            ));

            //regional availability
            $ProductRegionalAvailability = $factory->createInputFilter(array(
                "RegionalAvailability"=>$regionalAvailability
            ));

            //colors
            $ProductColors = $factory->createInputFilter(array(
                "Color"=>$color
            ));

            //add 'productBasic' input filter to form input filter
            $inputFilter->add($ProductBasicInputFilter, "ProductBasic");
            $inputFilter->add($ProductDimensionsInputFilter, "ProductDimensions");
            $inputFilter->add($ProductSoftwareInputFilter, "ProductSoftware");
            $inputFilter->add($ProductFeatureInputFilter, "ProductFeature");
            $inputFilter->add($ProductPowerSupplyInputFilter, "ProductPowerSupply");
            $inputFilter->add($ProductConnectivityInputFilter, "ProductConnectivity");
            $inputFilter->add($ProductRegionalAvailability, "productRegionalAvailability");
            $inputFilter->add($ProductColors, "productColor");

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}