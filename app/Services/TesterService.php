<?php

namespace App\Services;

use App\Models\Url;
use CurlHandle;
use DOMDocument;
use Illuminate\Support\Facades\Storage;

class TesterService
{
    private CurlHandle $curlHandle;

    public function __construct(
        public Url $url
    ) {
    }

    private function setGenericCurlOptions(): void{
        curl_setopt($this->curlHandle, CURLOPT_URL, $this->url->url);
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);

        // change this to have the headers in output
        curl_setopt($this->curlHandle, CURLOPT_HEADER, false);
        curl_setopt($this->curlHandle, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->curlHandle, CURLOPT_VERBOSE, true);

        // tls 1.2
        curl_setopt($this->curlHandle, CURLOPT_SSLVERSION, 6);
    }

    private function setCertificates(): void
    {
        // certificato di wsdev
        curl_setopt(
            $this->curlHandle,
            CURLOPT_CAINFO,
            Storage::disk('certificates')->path($this->url->certificate->ca_certificate)
        );
        curl_setopt($this->curlHandle, CURLOPT_CERTINFO, true);

        // chiavi di autenticazione
        curl_setopt(
            $this->curlHandle,
            CURLOPT_SSLKEY,
            Storage::disk('certificates')->path($this->url->certificate->private_key)
        );
        curl_setopt(
            $this->curlHandle,
            CURLOPT_SSLCERT,
            Storage::disk('certificates')->path($this->url->certificate->public_key)
        );
        // use this for Password protected private Key
        //curl_setopt($this->>curlHandle, CURLOPT_SSLCERTPASSWD, "");

        // to disable CA verification
        //curl_setopt($this->>curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($this->>curlHandle, CURLOPT_SSL_VERIFYPEER, false);
    }

    public function executeTest(): string
    {
        $this->curlHandle = curl_init();

        $this->setGenericCurlOptions();
        $this->setCertificates();

        // header
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: ".$this->url->soapAction,
            "Content-length: ".strlen($this->url->request),
        );

        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);

        // inject the Soap Envelope
        curl_setopt($this->curlHandle, CURLOPT_POST, true);
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $this->url->request);

        $result = curl_exec($this->curlHandle);

        curl_close($this->curlHandle);

        ray()->clearScreen();
        ray("CURL object", $this->curlHandle)->red();

        if (!$result) {
            return curl_error($this->curlHandle);
        }

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($result);
        return $dom->saveXML();
    }
}