<?php

namespace NNV;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Exception;

class RestCountries
{
    /**
     * Guzzle Client instance
     * @var GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * Fields to filter response
     * @var array
     */
    private $fields;

    public function __construct()
    {
        $this->guzzleClient = new Client([
            "base_uri" => "https://restcountries.eu/rest/v2/",
        ]);
        $this->fields = [];
    }

    /**
     * Filter output of request to include only the specified fields
     *
     * @param  array  $fields Fields to filter
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get all contries
     *
     * @return \NNV\RestCountries::execute
     */
    public function all()
    {
        return $this->execute("all");
    }

    /**
     * Search by country name. It can be the native name or partial name
     *
     * @param  string  $name       Country name
     * @param  boolean $isFullName Search by country full name
     * @return \NNV\RestCountries::execute
     */
    public function byName($name, $isFullName = false)
    {
        $fullNameRequest = ($isFullName ? ["fullText" => "true"] : []);
        $url = sprintf("name/%s", $name);

        return $this->execute($url, $fullNameRequest);
    }

    /**
     * Search by ISO 3166-1 2-letter or 3-letter country code
     *
     * @param  string|array $codes ISO country codes
     * @return \NNV\RestCountries::execute
     */
    public function byCodes($codes)
    {
        if (is_array($codes)) {
            return $this->execute("alpha", [
                "codes" => implode(";", $codes)
            ]);
        }

        return $this->execute("alpha/" . $codes);
    }

    /**
     * Search by ISO 4217 currency code
     *
     * @param  string $currencyCode Currency code
     * @return \NNV\RestCountries::execute
     */
    public function byCurrency($currencyCode)
    {
        $url = sprintf("currency/%s", $currencyCode);

        return $this->execute($url);
    }

    /**
     * Search by ISO 639-1 language code
     *
     * @param  string $languageCode Language code
     * @return \NNV\RestCountries::execute
     */
    public function byLanguage($languageCode)
    {
        $url = sprintf("lang/%s", $languageCode);

        return $this->execute($url);
    }

    /**
     * Search by capital city
     *
     * @param  string $capitalCity Capital city
     * @return \NNV\RestCountries::execute
     */
    public function byCapitalCity($capitalCity)
    {
        $url = sprintf("capital/%s", $capitalCity);

        return $this->execute($url);
    }

    /**
     * Search by calling code
     *
     * @param  string $callingCode Calling code
     * @return \NNV\RestCountries::execute
     */
    public function byCallingCode($callingCode)
    {
        $url = sprintf("callingcode/%s", $callingCode);

        return $this->execute($url);
    }

    /**
     * Search by region: Africa, Americas, Asia, Europe, Oceania
     *
     * @param  string $region Region name
     * @return \NNV\RestCountries::execute
     */
    public function byRegion($region)
    {
        $url = sprintf("region/%s", $region);

        return $this->execute($url);
    }

    /**
     * Search by region bloc
     *
     * @param  string $regionBloc Region bloc
     * @return \NNV\RestCountries::execute
     */
    public function byRegionalBloc($regionBloc)
    {
        $url = sprintf("regionalbloc/%s", $regionBloc);

        return $this->execute($url);
    }

    /**
     * Execute RestCountries request
     *
     * @param  string $url RestCountries request URL
     * @param  array  $requestParams Request params
     * @return mixed  Response JSON object or Exception
     */
    private function execute($url, $requestParams = [])
    {
        if (count($this->fields)) {
            $requestParams = array_merge($requestParams, [
                "fields" => implode(";", $this->fields),
            ]);
            $this->fields = [];
        }

        try {
            $response = $this->guzzleClient->get($url, [
                "query" => $requestParams,
            ])->getBody()->getContents();

            return json_decode($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
