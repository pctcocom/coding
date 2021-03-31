<?php

namespace Pctco\Coding\QRCode\Reader;

require_once('qrcode/QRCodeReader.php');

interface Reader {

    public function decode($image);


    public  function reset();


}
