<?php

namespace App\Services;

class TesterService
{
    public function __construct(
        public string $certFile,
        public string $certCA,
        public array $headers,
        public string $request,
        public string $url,
    ) {
    }

    public function executeTest(): string
    {
        $certFile = "/certificatiSvil/SVILUPPO_2018/SVILUPPO_2018";
        $certCA = "/certificatiSvil/certificato_wsdev.pem";
        $soapAction = "http://lettura.mavenapcl.ws.popso.it/v1/MavEnpaclServiceLetturaPortType_v1/elencoMavListRequest";
        $urlFirewall = "https://wsdev.popso.it:18004/MavEnpaclService_v1/lettura/mavEnpaclLettura.ws";

        $curlSES = curl_init();

        curl_setopt($curlSES, CURLOPT_URL, $urlFirewall);
        curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
        // cambiare questo per avere in output anche gli header
        curl_setopt($curlSES, CURLOPT_HEADER, false);
        //curl_setopt($curlSES, CURLOPT_SUPPRESS_CONNECT_HEADERS, false);
        curl_setopt($curlSES, CURLINFO_HEADER_OUT, true);

        // certificato di wsdev
        curl_setopt($curlSES, CURLOPT_CAINFO, getcwd().$certCA);
        curl_setopt($curlSES, CURLOPT_CERTINFO, true);

        // chiavi di autenticazione
        curl_setopt($curlSES, CURLOPT_SSLKEY, getcwd().$certFile.".pem");
        curl_setopt($curlSES, CURLOPT_SSLCERT, getcwd().$certFile."_CERT.pem");
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
            "SOAPAction: $soapAction",
            "Content-length: ".strlen($this->request),
        );
        curl_setopt($curlSES, CURLOPT_HTTPHEADER, $headers);

        // busta soap
        curl_setopt($curlSES, CURLOPT_POST, true);
        curl_setopt($curlSES, CURLOPT_POSTFIELDS, $this->request);

        $result = curl_exec($curlSES);

        curl_close($curlSES);

        ray()->clearScreen();
        ray("CURL object", $curlSES)->red();

        if (!$result) {
            return "ERRORE: ".curl_error($curlSES);
        }

        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($result);
        $xml_pretty = $dom->saveXML();

        ray()->xml($xml_pretty)->green();

        return $xml_pretty;
    }
}