<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-11
 * Time: 上午9:32
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductSoftwareScreenShots extends Fieldset{

    public function __construct()
    {
        parent::__construct("ProductSoftwareScreenShots");

        $this->setLabel("SCREENSHOTS");

        $dhr_string = new String();
        //product screentshots IOS
        $this->add(array(
            'type'=>"file",
            'name'=>'ScreenshotsIOS',
            'options'=>array(
                'label'=>"iOS"
            ),
        ));

        //product screentshots Android
        $this->add(array(
            'type'=>"file",
            'name'=>'ScreenshotsAndroid',
            'options'=>array(
                'label'=>"Android"
            ),
        ));

        //product screentshots Windows Phone
        $this->add(array(
            'type'=>"file",
            'name'=>'ScreenshotsWindowsPhone',
            'options'=>array(
                'label'=>"Windows Phone"
            ),
        ));

        //product screentshots Web Browser
        $this->add(array(
            'type'=>"file",
            'name'=>'ScreenshotsWeb',
            'options'=>array(
                'label'=>"Web Browser"
            ),
        ));
    }
} 