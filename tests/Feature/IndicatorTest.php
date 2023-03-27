<?php

namespace Tests\Feature;
use Tests\TestCase;

class IndicatorTest extends TestCase
{
    const REGISTERED_BY = '&procedimiento=Bienes y Servicios únicos';

    public function test_making_an_api_request_indicador1(): void
    {
        $date = '?mindate=2014-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","CAÑAR","GUAYAS"]';
        $proceso = '&proceso=Awards (adjudicación)';
        $response = $this->getJson('/api/indicador1'.$date.$region.$proceso);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','porcentaje']],
                        'colorMapData' => [
                            '*' => ['region','porcentaje']]
            ]
            );
    }
    public function test_making_an_api_request_indicador2(): void
    {
        $date = '?mindate=2015-07-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","CAÑAR","GUAYAS"]';
        $proceso = '&proceso=Awards (adjudicación)';
        $response = $this->getJson('/api/indicador2'.$date.$region.$proceso);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','porcentaje']],
                        'colorMapData' => [
                            '*' => ['region','porcentaje']]
            ]
            );
    }

    public function test_making_an_api_request_indicador3(): void
    {
        $date = '?mindate=2015-06-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador3'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','porcentaje']],
                        'colorMapData' => [
                            '*' => ['region','porcentaje']]
            ]
            );
    }

    public function test_making_an_api_request_indicador4(): void
    {
        $date = '?mindate=2015-05-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador4'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','porcentaje']],
                        'colorMapData' => [
                            '*' => ['region','porcentaje']]
            ]
            );
    }

    public function test_making_an_api_request_indicador5(): void
    {
        $date = '?mindate=2015-01-01&maxdate=2022-09-01';
        $region = '&region=["LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador5'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }

    public function test_making_an_api_request_indicador6(): void
    {
        $date = '?mindate=2015-02-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","PICHINCHA","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador6'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }
    public function test_making_an_api_request_indicador7(): void
    {
        $date = '?mindate=2015-10-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador7'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }
    public function test_making_an_api_request_indicador8(): void
    {
        $date = '?mindate=2015-11-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS"]';
        $response = $this->getJson('/api/indicador8'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }
    public function test_making_an_api_request_indicador9(): void
    {
        $date = '?mindate=2015-12-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","BOLIVAR"]';
        $response = $this->getJson('/api/indicador9'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','porcentaje']],
                        'colorMapData' => [
                            '*' => ['region','porcentaje']]
            ]
            );
    }
    public function test_making_an_api_request_indicador10(): void
    {
        $date = '?mindate=2014-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador10'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','register_number']],
                        'colorMapData' => [
                            '*' => ['region','register_number']]
            ]
            );
    }
    public function test_making_an_api_request_indicador11(): void
    {
        $date = '?mindate=2016-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador11'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','register_number']],
                        'colorMapData' => [
                            '*' => ['region','register_number']]
            ]
            );
    }
    public function test_making_an_api_request_indicador12(): void
    {
        $date = '?mindate=2017-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador12'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }
    public function test_making_an_api_request_indicador13(): void
    {
        $date = '?mindate=2018-08-01&maxdate=2022-09-01';
        $region = '&region=["GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador13'.$date.$region.self::REGISTERED_BY);
         $response
        ->assertStatus(200)
        ->assertJsonStructure([
                'chartData' => [
                    '*' => ['entidad_contratante','register_number']],
                    'colorMapData' => [
                        '*' => ['region','register_number']]
        ]
        );
    }
    public function test_making_an_api_request_indicador14(): void
    {
        $date = '?mindate=2019-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador14'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','register_number']],
                        'colorMapData' => [
                            '*' => ['region','register_number']]
            ]
            );
    }
    public function test_making_an_api_request_indicador15(): void
    {
        $date = '?mindate=2020-08-01&maxdate=2022-09-01';
        $region = '&region=["AZUAY","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","GALAPAGOS","BOLIVAR"]';
        $response = $this->getJson('/api/indicador15'.$date.$region.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' => [
                        '*' => ['yearmonth','variabilidad']],
                        'colorMapData' => [
                            '*' => ['region','variabilidad']]
            ]
            );
    }
    public function test_making_an_api_request_indicador16(): void
    {
        $date = '?mindate=2015-01-06&maxdate=2022-09-01';
        $response = $this->getJson('/api/indicador16'.$date.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' ]);
    }
    public function test_making_an_api_request_indicador17(): void
    {
        $date = '?mindate=2015-08-10&maxdate=2022-09-01';
        $response = $this->getJson('/api/indicador17'.$date.self::REGISTERED_BY);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' ]);
    }

}
