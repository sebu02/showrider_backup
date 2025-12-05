<?php

class paymentoption_model extends CI_Model {

    var $menu = '';
    var $menu1 = '';
    var $menu2 = '';
    var $data = '';

    function __construct() {

        parent::__construct();

        //$this->output->enable_profiler(TRUE);

        $this->tree = array();

        $this->parent = '';

        $this->arrow = '';

        $this->arra2 = array();

        date_default_timezone_set('Asia/Calcutta');
    }

    function GetByRow($table, $eventid, $field) {

        //echo $eventid;

        $this->db->where(array($field => $eventid));

        return $result = $this->db->get($table)->row();
    }

    function array_push_assoc($array, $key, $value) {

        $array[$key] = $value;

        return $array;
    }

    function payment_status() {

        $payment_status = array(
            "1" => "payment_pending",
            "2" => "payment_confirmed",
            "3" => "payment_processed",
            "4" => "payment_declined",
            "5" => "payment_failed",
            "6" => "payment_process_aborted",
        );

        return $payment_status;
    }

//ccavenue

    function encrypt($plainText, $key) {

        $secretKey = $this->hextobin(md5($key));

        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');

        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');

        $plainPad = $this->pkcs5_pad($plainText, $blockSize);

        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {

            $encryptedText = mcrypt_generic($openMode, $plainPad);

            mcrypt_generic_deinit($openMode);
        }

        return bin2hex($encryptedText);
    }

    function decrypt($encryptedText, $key) {

        $secretKey = $this->hextobin(md5($key));

        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

        $encryptedText = $this->hextobin($encryptedText);

        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');

        mcrypt_generic_init($openMode, $secretKey, $initVector);

        $decryptedText = mdecrypt_generic($openMode, $encryptedText);

        $decryptedText = rtrim($decryptedText, "\0");

        mcrypt_generic_deinit($openMode);

        return $decryptedText;
    }

    //*********** Padding Function *********************

    function pkcs5_pad($plainText, $blockSize) {

        $pad = $blockSize - (strlen($plainText) % $blockSize);

        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    function hextobin($hexString) {

        $length = strlen($hexString);

        $binString = "";

        $count = 0;

        while ($count < $length) {

            $subString = substr($hexString, $count, 2);

            $packedString = pack("H*", $subString);

            if ($count == 0) {

                $binString = $packedString;
            } else {

                $binString .= $packedString;
            }

            $count += 2;
        }

        return $binString;
    }

//ccavenue
}
