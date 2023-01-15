<?php

namespace App\Service;

use DOMDocument;
use DOMXPath;

class ParserService
{

    public function parser($url) {
        return;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $result = curl_exec($ch);

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML($result);
        libxml_use_internal_errors(false);

        $xpath = new DOMXPath($dom);
        $node = $xpath->query('//*[@id="__next"]/div[2]/div[2]/main/div/div/section/div/section/div[1]/div[2]', $dom)->item(0);
        var_dump($node);
    }

}



