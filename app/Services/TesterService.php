<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Facades\Storage;

class TesterService
{

    private string $privateKey;
    private string $publicKey;
    private string $certCA;

    public function __construct(
        public Url $url
    ) {
    }

    private function loadCertificates() {
        $this->privateKey = Storage::disk('certificates')->get($this->url->certificate->private_key);
        $this->publicKey = Storage::disk('certificates')->get($this->url->certificate->public_key);
        $this->certCA = Storage::disk('certificates')->get($this->url->certificate->ca_certificate);

        ray($this);
    }

    public function executeTest(): string
    {
        $curlSES = curl_init();

        curl_setopt($curlSES, CURLOPT_URL, $this->url->url);
        curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
        // cambiare questo per avere in output anche gli header
        curl_setopt($curlSES, CURLOPT_HEADER, false);
        //curl_setopt($curlSES, CURLOPT_SUPPRESS_CONNECT_HEADERS, false);
        curl_setopt($curlSES, CURLINFO_HEADER_OUT, true);

        // certificato di wsdev
        curl_setopt($curlSES, CURLOPT_CAINFO, Storage::disk('certificates')->path($this->url->certificate->ca_certificate));
        curl_setopt($curlSES, CURLOPT_CERTINFO, true);

        // chiavi di autenticazione
        curl_setopt($curlSES, CURLOPT_SSLKEY, Storage::disk('certificates')->path($this->url->certificate->private_key));
        curl_setopt($curlSES, CURLOPT_SSLCERT, Storage::disk('certificates')->path($this->url->certificate->public_key));
        //curl_setopt($curlSES, CURLOPT_SSLCERTPASSWD, "");

        // abilito le connessioni insicure
        //curl_setopt($curlSES, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($curlSES, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curlSES, CURLOPT_VERBOSE, true);

        // fisso a tls 1.2
        curl_setopt($curlSES, CURLOPT_SSLVERSION, 6);

        // header
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: ".$this->url->soapAction,
            "Content-length: ".strlen($this->url->request),
        );

        curl_setopt($curlSES, CURLOPT_HTTPHEADER, $headers);

        // busta soap
        curl_setopt($curlSES, CURLOPT_POST, true);
        curl_setopt($curlSES, CURLOPT_POSTFIELDS, $this->url->request);

        $result = curl_exec($curlSES);

        curl_close($curlSES);

        ray()->clearScreen();
        ray("CURL object", $curlSES)->red();

        if (!$result) {
            return curl_error($curlSES);
        }

        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($result);
        return $dom->saveXML();
    }
}