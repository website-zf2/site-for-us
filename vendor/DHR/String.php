<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-20
 * Time: 下午2:53
 */

namespace DHR;

class String {

   static function getDateSelectYears()
   {
      $nowDate = date("Y");
      $years = array();
      for($year = 1990; $year<=$nowDate; $year++ )
         $years[]= $year;
      return $years;
   }

   static function getDateSelectMonths()
   {
      $months = array(
          "1"=>"1 - January",
          "2"=>"2 - February",
          "3"=>"3 - March",
          "4"=>"4 - April",
          "5"=>"5 - May",
          "6"=>"6 - June",
          "7"=>"7 - July",
          "8"=>"8 - August",
          "9"=>"9 - September",
          "10"=>"10 - October",
          "11"=>"11 - November",
          "12"=>"12 - December",

      );

      return $months;
   }

   static function getDateSelectDays()
   {
      $days = array();
      for($day = 1; $day<=31; $day++ )
         $days[]= $day;
      return $days;
   }

   public function getEcosystem()
   {
      return array(
                           "1"=>"Open",
                           "2"=>"Closed"
                        );
   }

   public function getProductStatus()
   {
      return array(
         "1"=>"Stealth",
         "2"=>"Pre-Launch",
         "3"=>"Closed Beta",
         "4"=>"Beta",
         "5"=>"Released (Live)",
          '7'=>"Discontinued",
         "6"=>"Cancelled"
      );
   }
    //multi select
   public function getProductConnectivity(){
      return array(
           "1"=>"Wi-Fi",
          "4"=>"ZigBee",
          "2"=>"Z-Wave",
          '6'=>"6LoWPAN",
          '7'=>"Bluetooth",
          "5"=>"Infrared (IR)",
          '8'=>"Insteon",
//          '9'=>"EnOcean",
          '10'=>"Ethernet",
//          '3'=>"433MHz",
          '11'=>"Other frequency",

      );
   }
    //multi select
   public function getProductPowerSupply(){
      return array(
          "1"=>" Power Cable/Adapter ",
          "2"=>"AA Battery",
          "3"=>"AAA Battery",
          "4"=>"AAAA Battery",
          "5"=>"C (LR14) Battery",
          "6"=>"CR123A Battery",
          "7"=>"CR2 Battery",
          "8"=>"CR2032 Battery",
          "9"=>"CR2450 Battery",
          "10"=>"CR2430 Battery",
          "11"=>"ER14250 Battery",
          "12"=>"9-volt Battery",
          "13"=>"Proprietary Battery",
          "14"=>"Solar",

      );
   }

   public function getProductAvailability(){
      return array(
         "A"=>"A",
         "B"=>"B",
         "C"=>"C",
      );
   }

    //multi select
   public function getProductCategory()
   {
       return array(
                        "1"=>"Air Conditioner",
                        "2"=>"Air Conditioner Controller",
                        "3"=>"Air Purifier",
                        "4"=>"Audio Speaker",
                        "52"=>"Bar Codes Scanner",
                        "5"=>"Basic Door",
                        "6"=>"Bathtub",
                        "7"=>"Blood Pressure Monitor",
                        "8"=>"Camera",
                        "9"=>"Clothes Dryer",
                        "10"=>"Coffee Machine",
                        "11"=>"Cooker",
                        "12"=>"Curtain Rail",
                        "13"=>"Data Storage",
                        "14"=>"Dishwasher",
                        "15"=>"Door Bell",
                        "16"=>"Door Lock",
                        "53"=>"Egg Tray",
                        "54"=>"Floor Mopper",
                        "55"=>"Floor Scrubber",
                        "17"=>"Fridge",
                        "18"=>"Garage Door Controller",
                        "19"=>"Gateway / Hub",
                        "20"=>"Heater",
                        "56"=>"Infrared Controller",
                        "21"=>"Irrigation Controller",
                        "57"=>"Kitchen Scale",
                        "23"=>"Light Bulb",
                        "24"=>"Light Switch",
                        "25"=>"Lightstrip",
                        "26"=>"Mirror",
                        "27"=>"Oven",
                        "28"=>"Pet Feeder",
                        "29"=>"Plant Growing System",
                        "30"=>"Plug",
                        "31"=>"Radiator Controller",
                        "32"=>"Remote Control",
                        "33"=>"Scale",
                        "58"=>"Sensor: Accelerometer",
                        "59"=>"Sensor: Air Quality",
                        "61"=>"Sensor: Barometer",
                        "62"=>"Sensor: CO2",
                        "63"=>"Sensor: Door",
                        "64"=>"Sensor: Dry Contact",
                        "65"=>"Sensor: Gas",
                        "66"=>"Sensor: Humidity",
                        "67"=>"Sensor: Infrared",
                        "68"=>"Sensor: Light",
                        "69"=>"Sensor: Motion",
                        "70"=>"Sensor: Presence",
                        "71"=>"Sensor: Proximity",
                        "72"=>"Sensor: Soil Moisture",
                        "73"=>"Sensor: Sound",
                        "74"=>"Sensor: Temperature",
                        "75"=>"Sensor: Vibration",
                        "76"=>"Sensor: Water/Moisture",
                        "78"=>"Sensor: Window",
                        "35"=>"Shades / Blinds",
                        "36"=>"Shower",
                        "37"=>"Shower Head Water Meter",
                        "38"=>"Siren",
                        "39"=>"Smoke Detector",
                        "40"=>"Switch",
                        "41"=>"Thermostat",
                        "42"=>"Toilet",
                        "43"=>"Tracker",
                        "44"=>"TV",
                        "45"=>"Vacuum Cleaner",
                        "46"=>"Washing Machine",
                        "47"=>"Water Tap",
                        "48"=>"Water Valve",
                        "49"=>"Wearable",
                        "50"=>"Window Cleaner",
                        "51"=>"Window Opener",
                        '79'=>"Wireless Signal Extender"
       );
   }
//multi select
    public function getProductRegionalAvailability()
    {
        return array(
            "1"=>"Albania",
            "2"=>"Algeria",
            "3"=>"Argentina",
            "4"=>"Australia",
            "5"=>"Austria",
            "6"=>"Bahrain",
            "7"=>"Belgium",
            "8"=>"Brasil",
            "9"=>"Bulgaria",
            "10"=>"Canada",
            "11"=>"Chile",
            "12"=>"China",
            "13"=>"Colombia",
            "14"=>"Croatia",
            "15"=>"Cyprus",
            "16"=>"Czech Republic",
            "17"=>"Democratic Republic of Congo",
            "18"=>"Denmark",
            "19"=>"Dominican Republic",
            "20"=>"Egypt",
            "21"=>"Ecuador",
            "22"=>"Estonia",
            "23"=>"Finland",
            "24"=>"France",
            "25"=>"Germany",
            "26"=>"Greece",
            "27"=>"Hong Kong",
            "28"=>"Hungary",
            "29"=>"India",
            "30"=>"Indonesia",
            "31"=>"Iran",
            "32"=>"Ireland",
            "33"=>"Israel",
            "34"=>"Italy",
            "35"=>"Japan",
            "36"=>"Kosovo",
            "37"=>"Latvia",
            "38"=>"Lebanon",
            "39"=>"Lithuania",
            "40"=>"Luxembourg",
            "41"=>"Malaysia",
            "42"=>"Mexico",
            "43"=>"Moldova",
            "44"=>"Morocco",
            "45"=>"Netherlands",
            "46"=>"New Zealand",
            "47"=>"Nigeria",
            "48"=>"Norway",
            "49"=>"Pakistan",
            "50"=>"Paraguay",
            "51"=>"Peru",
            "52"=>"Philippines",
            "53"=>"Poland",
            "54"=>"Portugal",
            "55"=>"Romania",
            "56"=>"Russia",
            "57"=>"Saudi Arabia",
            "58"=>"Singapore",
            "59"=>"Slovakia",
            "60"=>"Slovenia",
            "61"=>"South Africa",
            "62"=>"South Korea",
            "63"=>"Spain",
            "64"=>"Sweden",
            "65"=>"Switzerland",
            "66"=>"Thailand",
            "67"=>"Turkey",
            "68"=>"Ukraine",
            "69"=>"United Arab Emirates",
            "70"=>"United Kingdom",
            "71"=>"United States",
            "72"=>"Venezuela"
        );
    }

    //multi select
    public function getOSCompatibility()
    {
        return array(
            "1"=>"iOS",
            "3"=>"Android",
            "2"=>"Windows Phone",
//            "4"=>"Mac",
            "5"=>"Web Browser"
        );
    }


    //multi select
    public function getProductColors()
    {
        return array(
            "1"=>"Color 1",
            "2"=>"Color 2",
            "3"=>"Color 3",
            "4"=>"Color 4",
        );
    }
    public static function entertobr( $str)
    {
        return str_replace(array("\n\r", "\n"), "<br/>", $str);
    }

    public function indexToArraylist($indexstring, $dataArray)
    {
        $indexstring = explode("&&&", $indexstring);
        $result = array();
        foreach($indexstring as $index)
            $result[]=$dataArray[$index];

        return $result;

    }

} 