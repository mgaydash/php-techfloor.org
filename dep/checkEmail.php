<?php
    function isValidEmail($emailAddress)
    {
        $emailAddressArray = array();     
        $emailAddressArray = str_split($emailAddress);
        return(checkAtSymbol($emailAddressArray) && checkPeriod($emailAddressArray));
    }
 
    function checkAtSymbol($emailAddressArray)
    {
        $atFoundStatus = false;
        for($i=0;$i<count($emailAddressArray);$i++)
        {
            if($emailAddressArray[$i] == '@')
                $atFoundStatus = true;
            if($i == 0 && $emailAddressArray[$i] == '@')
               return false;
            else if($i == (count($emailAddressArray)-1) && $emailAddressArray[(count($emailAddressArray)-1)] == '@')
                return false;
        }
        return $atFoundStatus;
    }
    function checkPeriod($emailAddressArray)
    {
        $atFoundStatus = false;
        for($i=0;$i<count($emailAddressArray);$i++)
        {
            if($emailAddressArray[$i] == '.')
                $atFoundStatus = true;
            if($i == 0 && $emailAddressArray[$i] == '.')
               return false;
            else if($i == (count($emailAddressArray)-1) && $emailAddressArray[(count($emailAddressArray)-1)] == '.')
                return false;
        }
        return $atFoundStatus;
    }
?>
