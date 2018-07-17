<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use League\Csv\Writer;
use Schema;
use SplTempFileObject;
use Exporter;

class CountryController extends Controller
{
    /**
     * Chamada página inicial com botões
     */
    public function index(){
        return view('country.index');
    }

    /**
     * Chamada para listagem do banco
     */
    public function list() {
        $countries = Country::orderBy('name', 'desc')->get();

        return view('country.list', [
            'countries' => $countries
        ]);
    }

    /**
     * Chamada para listagem de arquivo
     */
    public function listFile($file) {
        // existe arquivo
        $exists = Storage::disk('local')->has('data/'.$file);
        // existe cache desse arquivo
        $existsCache = Cache::has($file);
        
        if (!$exists && !$existsCache) {
            exit('Arquivo não encontrado.');
        }

        // não existe o arquivo mas existe o cache : Duração 10 minutos
        if (!$exists) {
            $content = Cache::get($file);
        } else {
            $content = Storage::disk('local')->get('data/'.$file);
            $expiresAt = now()->addMinutes(10);
            Cache::put($file, $content, $expiresAt);
        }

        $retorno = [];
        if($content) {
        
            $result[] = array_filter(array_map("trim", explode("\n", $content)));
            if (count($result) > 0) 
            {
                foreach($result[0] as $linha) 
                {
                    $linha = preg_replace('/\s+/', ' ', $linha);
                    $valor = explode(' ', $linha);
                    if (isset($valor[0]) && isset($valor[1])) {
                        $retorno[] = (object) [
                            'initial' => trim($valor[0]),
                            'name' => trim($valor[1])
                        ];
                    }
                }
                // ordenando decrescente
                $retorno2 = collect($retorno);
                $retorno = $retorno2->sortByDesc('name');
            }
        }

        return view('country.list', [
            'countries' => $retorno
        ]);
    }

    /**
     * Chamada para download csv
     */
    public function download($file)
    {
        // existe arquivo
        $exists = Storage::disk('local')->has('data/'.$file);
        // existe cache desse arquivo
        $existsCache = Cache::has($file);
        
        if (!$exists && !$existsCache) {
            exit('Arquivo não encontrado.');
        }

        // não existe o arquivo mas existe o cache : Duração 10 minutos
        if (!$exists) {
            $content = Cache::get($file);
        } else {
            $content = Storage::disk('local')->get('data/'.$file);
            $expiresAt = now()->addMinutes(10);
            Cache::put($file, $content, $expiresAt);
        }

        $retorno = $this->carregarLista($content);

        $this->createCsv($retorno, $file);
    }

    /**
     * Chamada para download excel
     */
    public function excel($file) 
    {
        // existe arquivo
        $exists = Storage::disk('local')->has('data/'.$file);
        // existe cache desse arquivo
        $existsCache = Cache::has($file);
        
        if (!$exists && !$existsCache) {
            exit('Arquivo não encontrado.');
        }

        // não existe o arquivo mas existe o cache : Duração 10 minutos
        if (!$exists) {
            $content = Cache::get($file);
        } else {
            $content = Storage::disk('local')->get('data/'.$file);
            $expiresAt = now()->addMinutes(10);
            Cache::put($file, $content, $expiresAt);
        }
        
        $retorno = $this->carregarLista($content);

        $excel = Exporter::make('Excel');
        $excel->load($retorno);
        return $excel->stream(str_replace('.txt', '', $file).".xlsx");
    }

    /**
     * Carrega lista dos paises
     */
    private function carregarLista($content)
    {
        $retorno = [];
        if($content) {
        
            $result[] = array_filter(array_map("trim", explode("\n", $content)));
            if (count($result) > 0) 
            {
                foreach($result[0] as $linha) 
                {
                    $linha = preg_replace('/\s+/', ' ', $linha);
                    $valor = explode(' ', $linha);
                    if (isset($valor[0]) && isset($valor[1])) {
                        $other = '(' . trim($valor[0]) . ') ' . trim($valor[1]);
                        $retorno[] = (object) [
                            'initial' => trim($valor[0]),
                            'name' => trim($valor[1]),
                            'other' => $other
                        ];
                        $other = '';
                    }
                }
                // ordenando decrescente
                $retorno2 = collect($retorno);
                $retorno = $retorno2->sortByDesc('name');
            }
        }
        return $retorno;
    }

    /**
     * Preparando arquivo csv
     */
    private function createCsv(Collection $modelCollection, $file){

        $csv = Writer::createFromFileObject(new SplTempFileObject());
    
        // This creates header columns in the CSV file - probably not needed in some cases.
        $csv->insertOne(['initial', 'name', 'other']);
    
        foreach ($modelCollection as $data){
            $csv->insertOne((array) $data);
        }
    
        $csv->output(str_replace('.txt', '', $file) . '.csv');
    }
}
