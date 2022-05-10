<?php

namespace App\Services;

use App\Models\Test;
use App\Models\Url;
use CurlHandle;
use DOMDocument;
use Illuminate\Support\Facades\Storage;

class TesterService
{
    private CurlHandle $curlHandle;
    private string $response;
    private string $beginTime;
    private string $endTime;

    private string $curlInfo;
    private string $requestHeaders;
    private string $certificates;

    public function __construct(
        public Url $url
    ) {
    }

    private function setGenericCurlOptions(): void
    {
        curl_setopt($this->curlHandle, CURLOPT_URL, $this->url->url);
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);

        // change this to have the headers in output
        curl_setopt($this->curlHandle, CURLOPT_HEADER, false);
        // we need CURLINFO_HEADER_OUT to have access on request headers
        curl_setopt($this->curlHandle, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->curlHandle, CURLOPT_VERBOSE, true);

        // tls 1.2
        curl_setopt($this->curlHandle, CURLOPT_SSLVERSION, 6);
    }

    private function setCertificates(): void
    {
        // CA Certificate
        if (!is_null($this->url->certificate->ca_certificate)) {
            curl_setopt(
                $this->curlHandle,
                CURLOPT_CAINFO,
                Storage::disk('certificates')->path($this->url->certificate->ca_certificate)
            );
            curl_setopt($this->curlHandle, CURLOPT_CERTINFO, true);
        }

        // Authentication keys (must be provided both public and private key
        if (!is_null($this->url->certificate->private_key) && !is_null($this->url->certificate->public_key)) {
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
            //curl_setopt($this->curlHandle, CURLOPT_SSLCERTPASSWD, "");
        }

        // to disable CA verification
        curl_setopt($this->curlHandle, CURLOPT_SSL_VERIFYPEER, false);
    }

    public function executeTest(): string
    {
        $this->curlHandle = curl_init();

        $this->setGenericCurlOptions();
        if ($this->url->useCertificates()) {
            $this->setCertificates();
        }

        // default headers
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: ".strlen($this->url->request),
        );

        if (!is_null($this->url->soap_action)) {
            $headers[] = "SOAPAction: ".$this->url->soap_action;
        }

        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);

        // inject the Soap Envelope
        curl_setopt($this->curlHandle, CURLOPT_POST, true);
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $this->url->request);

        $this->beginTime = now();
        $result = curl_exec($this->curlHandle);
        $this->endTime = now();

        curl_close($this->curlHandle);

        ray("CURL object", $this->curlHandle)->red();

        if (!$result) {
            $this->response = curl_error($this->curlHandle);
            $this->saveTestResult();
            return $this->response;
        }

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($result);
        $this->response = $dom->saveXML();

        $version = curl_version();
        extract(curl_getinfo($this->curlHandle));
        $this->curlInfo = <<<EOD
Code...: $http_code ($redirect_count redirect(s) in $redirect_time secs)
Content: $content_type Size: $download_content_length (Own: $size_download) Filetime: $filetime
Time...: $total_time Start @ $starttransfer_time (DNS: $namelookup_time Connect: $connect_time Request: $pretransfer_time)
Speed..: Down: $speed_download (avg.) Up: $speed_upload (avg.)
Curl...: v{$version['version']}
EOD;

        $this->requestHeaders = $request_header;
        $this->certificates = json_encode($certinfo);;
        $this->saveTestResult();

        return $this->response;
    }

    private function checkSuccess(): bool
    {
        return str_contains($this->response, $this->url->expected_response);
    }

    private function saveTestResult(): void
    {
        Test::create([
            'url_id' => $this->url->id,
            'request' => $this->url->request,
            'request_date' => $this->beginTime,
            'response' => $this->response,
            'response_date' => $this->endTime,
            'response_time' => curl_getinfo($this->curlHandle, CURLINFO_TOTAL_TIME_T),
            'response_ok' => $this->checkSuccess(),
            'curl_info' => $this->curlInfo,
            'called_url' => $this->url->url,
            'certificates_used' => $this->certificates,
            'request_headers' => $this->requestHeaders,
        ]);
    }

}