<?php
/**
 * Created by PhpStorm.
 * User: RayZheng
 * Date: 8/7/14
 * Time: 9:35 上午
 */

namespace Application\Model\Entity;


class Product
{
    protected $currentProduct;

    /*
     * */
    public function __construct($product=null)
    {
        if (is_array($product))
            $this->currentProduct = $product;
        else
            $this->currentProduct = array(
                'ProductInnerId' => '',
                'ProductId' => '',
                'Ecosystem' => '',
                'ProductName' => '',
                'Launched' => '',
                'Status' => '',
                'ProductGeneration' => '',
                'GenerationLog' => '',
                'Owner' => '',
                'ShortDescription' => '',
                'Website' => '',
                'Price' => '',
                'EnergyEfficient' => '',
                'RemoteAccess' => '',
                'Programmable' => '',
                'RandomizedProgram' => '',
                'Autonomous' => '',
                'CloudFocused' => '',
                'VoiceControl' => '',
                'Description' => '',
                'DimensionsHeight' => '',
                'DimensionsWidth' => '',
                'DimensionsDepth' => '',
                'Connectivity' => '',
                'PowerSupply' => '',
                'Color' => '',
                'Availability' => '',
                'ProductCategory' => '',
                'AmateursPurchasable' => '',
                'AmateursInstall' => '',
                'API' => '',
                'APIName' => '',
                'APIWebsite' => '',
                'ImproveHealth' => '',
                'ImproveSafety' => '',
                'Weight' => '',
                'NoisyLevel' => '',
                'OSCompatibility' => '',
                'BatteryLifeTime' => '',
                'RegionalAvailability' => ''
            );
    }

    public function getAllFields()
    {
        return (array_keys($this->currentProduct));
    }
} 