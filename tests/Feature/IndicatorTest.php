<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndicatorTest extends TestCase
{
    public function test_making_an_api_request_indicador1(): void
    {
        $response = $this->getJson('/api/indicador1?mindate=2015-08-01&maxdate=2022-09-01&region=["AZUAY","CAÑAR","GUAYAS"]&proceso=Awards (adjudicación)');
 
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
        $response = $this->getJson('api/indicador2?mindate=2015-08-01&maxdate=2022-09-01&region=["AZUAY","CAÑAR","GUAYAS"]&proceso=Awards (adjudicación)');
 
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
        $response = $this->getJson('api/indicador3?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
 
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
        $response = $this->getJson('/api/indicador4?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
 
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
        $response = $this->getJson('/api/indicador5?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('/api/indicador6?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('/api/indicador7?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('/api/indicador8?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('api/indicador9?mindate=2015-01-01&maxdate=2015-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Subasta Inversa Electrónica');
 
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
        $response = $this->getJson('api/indicador10?mindate=2015-01-01&maxdate=2015-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Subasta Inversa Electrónica');
 
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
        $response = $this->getJson('api/indicador11?mindate=2015-01-01&maxdate=2015-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Subasta Inversa Electrónica');
 
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
        $response = $this->getJson('/api/indicador12?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('/api/indicador13?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
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
        $response = $this->getJson('/api/indicador14?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
 
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
        $response = $this->getJson('/api/indicador15?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
 
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
        $response = $this->getJson('/api/indicador16?mindate=2015-08-01&maxdate=2022-12-01&procedimiento=Bienes y Servicios únicos');
 
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' ]);
    }
    public function test_making_an_api_request_indicador17(): void
    {
        $response = $this->getJson('/api/indicador4?mindate=2015-08-01&maxdate=2022-12-01&region=["AZUAY","ZAMORA CHINCHIPE","SANTA ELENA","LOJA","GUAYAS","NAPO","PICHINCHA","ESMERALDAS","CARCHI","COTOPAXI","SUCUMBIOS","IMBABURA","MANABI","LOS RIOS","SANTO DOMINGO DE LOS TSACHILAS","EL ORO","TUNGURAHUA","CAÑAR","MORONA SANTIAGO","ORELLANA","PASTAZA","CHIMBORAZO","GALAPAGOS","BOLIVAR"]&procedimiento=Bienes y Servicios únicos');
 
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'chartData' ]);
    }

}
