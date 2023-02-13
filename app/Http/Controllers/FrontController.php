<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\HTTP\Response;

use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    const DEFAULT_MAX_YEAR = 2021;
    const DEFAULT_MIN_YEAR = 2015;
    const DEFAULT_METHOD   = ["name" => "Todos los tipos de contratación", "url"  => "all"];

    /**
     * the home page
     * ----------------------------------------------------------------
     */
    public function home()
    {
        $minYear = $this->minYear();
        $maxYear = $this->maxYear();
        $methods = $this->methods();

        // $update = DB::table('log')
        //     ->select("status", "years", "created_at", "updated_at")
        //     ->where("type", "publish_data")
        //     ->where("status", 1)
        //     ->orderBy("id", "desc")
        //     ->first();

        $update = $this->last_update();

      return view('home', [
        "from"      => $minYear,
        "to"        => $maxYear,
        "url_name"  => config('app.url_name'),
        "update"    => $update,
        "methods"   => $methods
     /*, "regions" => $regions, 'types' => $types*/]);
    }

    /**
     * the search page
     * ----------------------------------------------------------------
     */
    public function search(Request $request)
    {
        $minYear = $this->minYear();
        $maxYear = $this->maxYear();
        $methods = $this->methods();
        $update = $this->last_update();
        return view('search', [
            "from"      => $minYear,
            "to"        => $maxYear,
            "methods"   => $methods,
            "request"   => $this->getUrlSettings($request),
            "url_name"  => config('app.url_name'),
            "update"    => $update
        ]);
    }

    /**
     * the api documentation page
     * ----------------------------------------------------------------
     */
    public function apidoc()
    {
        $update = $this->last_update();
        return view ('apidoc', ["url_name" => config('app.url_name'), "update" => $update]);
    }

    /**
     * the contract process page
     * ----------------------------------------------------------------
     */
    public function ocds(Request $request, $ocds)
    {
        $update = $this->last_update();
        $m      = Record::where('ocid', $ocds)->first();
        $ocds   =  json_decode($m->data);
        $etapa  = filter_var($request->etapa, FILTER_SANITIZE_STRING);

        return view('ocds', [
            "update" => $update,
            "json" => $m->data,
            "etapa" => $etapa,
            "ocds" =>  $ocds->releases[0],//(isset($ocds->records[0]->releases)  ? $ocds->records[0]->releases[0]  : $ocds->records[0]->compiledRelease),
            "amount" => $m->amount,
            "url_name" => config('app.url_name')]);
    }


    /**
     * download page
     * ----------------------------------------------------------------
     */
    public function download()
    {
        $minYear = $this->minYear();
        $maxYear = $this->maxYear();
        $minMonth = Record::select('month')->whereNull('is_agreement')->where('year', '=', $minYear)->orderBy('month', 'asc')->first();
        if($minMonth){
          $minMonth = $minMonth->month;
        }else{
          $minMonth = 1;
        }
        $maxMonth = Record::select('month')->whereNull('is_agreement')->where('year', '=', $maxYear)->orderBy('month', 'desc')->first();
        if($maxMonth){
          $maxMonth = $maxMonth->month;
        }else{
          $maxMonth = 1;
        }
        $data    = ["from" => "$minYear/$minMonth", "to" => "$maxYear/$maxMonth"];
        $temp_m = Record::select('method', 'internal_type')->whereNull('is_agreement')->whereNotNull('method')->whereNotNull('internal_type')->groupBy('method', 'internal_type')->get();
        $methods = [];
        foreach ($temp_m as $method) {
          array_push($methods, [
            "name" => $method->internal_type,
            "url"  => $method->internal_type
          ]);
        }
        array_push($methods, [
          "name" => "Todos los tipos de contratación",
          "url"  => "all",
        ]);

        // años para convenios marco
        $fa_years = Record::select('year')->where("is_agreement", 1)->groupBy("year")->get();

        // $update = DB::table('log')
        //     ->select("status", "years", "created_at", "updated_at")
        //     ->where("type", "publish_data")
        //     ->where("status", 1)
        //     ->orderBy("id", "desc")
        //     ->first();
        $update = $this->last_update();

        return view('bulk-downloads', [
            "data" => $data,
            "methods" => $methods,
            "url_name" => config('app.url_name'),
            "fa_years" => $fa_years,
            "update" => $update
        ]);
    }

    /**
     * Regresa total de procedimientos para el select de la descarga
     * @param string year
     * @return json data
     */
    public function get_totals(Request $request)
    {
      $month  = null;
      $year   = (int)$request->input('year');
      $method = $request->input('method');
      $method = $method == "all" ? null : $method;
      if($request->input('month')){
        $month = intval($request->input('month'));
      }
      if($month && $method){

        $count = Record::where('year', $year)
                  ->where('month', $month)
                  ->where('internal_type', $method)
                  ->whereNull('is_agreement')
                  ->count();
        return response()->json([
          'count' => $count
        ]);

      }elseif(!$month && $method){
        $count = Record::where('year', $year)
                  ->where('internal_type', $method)
                  ->whereNull('is_agreement')
                  ->count();
        return response()->json([
          'count' => $count
        ]);

      }elseif($month && !$method){
        $count = Record::where('year', $year)->where('month', $month)->whereNull('is_agreement')
                  ->count();
        return response()->json([
          'count' => $count
        ]);
      }else{
        $count = Record::where('year', $year)->whereNull('is_agreement')
                  ->count();
        return response()->json([
          'count' => $count
        ]);
      }
    }

    /**
     * Get the name of the month.
     * @param int month
     * @return string name
     */
    public function name($month)
    {
      switch ($month) {
        case 12:
          $name = "diciembre";
          break;
        case 11:
          $name = "noviembre";
          break;
        case 10:
          $name = "octubre";
          break;
        case 9:
          $name = "septiembre";
          break;
        case 8:
          $name = "agosto";
          break;
        case 7:
          $name = "julio";
          break;
        case 6:
          $name = "junio";
          break;
        case 5:
          $name = "mayo";
          break;
        case 4:
          $name = "abril";
          break;
        case 3:
          $name = "marzo";
          break;
        case 2:
          $name = "febrero";
          break;
        case 1:
          $name = "enero";
          break;
        default:
          $name = "_xx_xx";
          break;
      }
      return $name;
    }

    /**
    * return file.
    *
    * @return Response
    */
    public function get_download(Request $request)
    {
      $m = null;
      if($request->input('month')){
        $m = intval($request->input('month'));
      }
      //dd($m);
      if($request->input('type') && $request->input('year')){
        $year = $request->input('year');
        switch ($request->input('type')) {
          case 'csv':
            $type = '.zip';
            $file_start_name = 'releases';
            $f = 'csv';
            break;
          case 'xlsx':
            $type = '.xlsx';
            $file_start_name = 'releases';
            $f = 'excel';
            break;
          case 'json':
            $type = '.zip';
            $file_start_name = 'releases';
            $f = 'json';
            break;
          case 'convenios':
            $type = '.json';
            $file_start_name = 'convenios';
            $f = 'convenios';
            break;
          default:
            $type = '.zip';
            $file_start_name = 'releases';
            $f = 'json';
          break;
        }
        if($m){
          $month = $this->name($m);
          if($request->input('method')){
            if($request->input('method') == 'all'){
              $name = $file_start_name."_".$year."_".$month.$type;
              return response()->download(storage_path("app/$f/$year/{$name}"));
            }else{
              # falta cambiar este
              $name = $file_start_name."_".$year."_".$month."_".$this->remove_characters($request->input('method')).$type;
              return response()->download(storage_path("app/$f/$year/{$name}"));
            }
          }else{
            $name = $year."_".$month.$type;
            return response()->download(storage_path("app/$f/$year/{$name}"));
          }

        }else{
          if($request->input('method')){
            if($request->input('method') == 'all'){
              $name = $file_start_name."_".$year.$type;
              return response()->download(storage_path("app/$f/$year/{$name}"));
            }else{
              $name = $file_start_name."_".$year."_".$this->remove_characters($request->input('method')).$type;
              return response()->download(storage_path("app/$f/$year/{$name}"));
            }
          }else{
            $name = $file_start_name."_".$year.$type;
            return response()->download(storage_path("app/$f/$year/{$name}"));
          }
        }
      }
      # return view('bulk-downloads');

    }


    /**
     * remove spaces and accents
     * @param string method
     * @return string name
     */
    public function remove_characters($method)
    {
      $method = trim(str_replace('-', '', $method));
      $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                              'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                              'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                              'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                              'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', "."=> "", ","=> "", "-"=> "", "–" => "");
      return strtolower(str_replace(' ', '_', str_replace("  ", " ", strtr($method, $unwanted_array))));
    }

    /**
     * private stuff
     * ----------------------------------------------------------------
     */

     /**
     * get Max Year
     * @return Int
     */
    private function maxYear(){
        $year = Record::select('year')->whereNull('is_agreement')->orderBy('year', 'desc')->first();
        if($year){
          $year = $year->year;
        }else{
          $year = self::DEFAULT_MAX_YEAR;
        }
        return $year;
    }

    /**
     * get Min Year
     * @return Int
     */
    private function minYear(){
        $year = Record::select('year')->whereNull('is_agreement')->orderBy('year', 'asc')->first();
        if($year){
          $year = $year->year;
        }else{
          $year = self::DEFAULT_MIN_YEAR;
        }
        return $year;
    }

    /**
     * get Methods
     * @return Int
     */
    private function methods():array{
        $methods = [self::DEFAULT_METHOD];
        $temp_m  = Record::select('method', 'internal_type')->whereNotNull('method')
                                                            ->whereNotNull('internal_type')
                                                            ->whereNull('is_agreement')
                                                            ->groupBy('method', 'internal_type')
                                                            ->get();
        foreach ($temp_m as $method) {
            $methods[] = ["name" => $method->internal_type, "url"  => $method->internal_type];
        }

        return $methods;
    }

    private function last_update(){
        $update = DB::table('log')
            ->select("updated_at")
            ->where("type", "publish_data")
            ->whereNotNull("years")
            ->where("status", 1)
            ->orderBy("id", "desc")
            ->first();

        if(isset($update)){
            $date = date_create($update->updated_at);
            return date_format($date,"d/m/Y");
        }
        else{
            return null;
        }
    }

    /**
     * get search props
     * @return Array
     */
    private function getUrlSettings($req){
        // sanitize request values
        $year     = (int)$req->year >= $this->minYear() && (int)$req->year <= $this->maxYear() ? (int)$req->year : null;
        $search   = $req->search ? filter_var($req->search, FILTER_SANITIZE_STRING) : null;
        $page     = $req->page && (int)$req->page > 0 ? (int)$req->page : null;
        $methods  = $this->methods();
        $type     = array_search($req->type, array_column($methods, 'url')) !== false ? $req->type : null;
        $buyer    = $req->buyer ? filter_var($req->buyer, FILTER_SANITIZE_STRING) : null;
        $supplier = $req->supplier ? filter_var($req->supplier, FILTER_SANITIZE_STRING) : null;

        return [
            "year"     => $year,
            "search"   => $search,
            "page"     => $page,
            "type"     => $type,
            "buyer"    => $buyer,
            "supplier" => $supplier
        ];
    }

    /**
     * about
     * @return \Illuminate\View\View
     */
    public function about()
    {
        $update = $this->last_update();
        return view('about', ["url_name" => config('app.url_name'), "update"    => $update]);
    }

    /**
     * notes
     * @return \Illuminate\View\View
     */
    public function notes()
    {
        return view('notes', ["url_name" => config('app.url_name')]);
    }
}
