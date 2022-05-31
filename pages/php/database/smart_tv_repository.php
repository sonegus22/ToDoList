<?php
// carica il codice della classe JSONDB e della classe SmartTV
require_once("JSONDB.php");
require_once("json.php");
require_once("dataTypes.php");

//require("smart_tv.php");

// specifica di usare la classe JSONDB presente nello namespace Jajo
use \Jajo\JSONDB;


class SmartTVRepository {
    private static string $directoryDB = __DIR__;
    private static string $tableName = 'smart_tvs';
    private static string $fileName = 'smart_tvs.json';

    /**
     * Restituisce un array di tutte le istanze di SmartTV presenti nel database
     * @return array Array delle istanze individuate
     */
    public static function estrai_tutti(): array {
        $arraySmartTV = [];
        try {
            // crea una istanza di database che fa rifeirmento alla directory specificata
            $db = new JSONDB(self::$directoryDB);
            // estrae tutte tutti gli elementi dal database con nome file smart_tvs.json
            $arrayDB = $db->select( '*' )
            	->from( self::$fileName )
                ->get();
            // scandisce tutto l'array ricavato con la query, istanzia le SmartTV, aggiunge all'array dei risultati
            foreach ($arrayDB as $objDB) {
                $objSmartTV = new SmartTv(
                    $objDB["marca"],
                    $objDB["modello"],
                    $objDB["numero_seriale"],
                    $objDB["diagonale"],
                    $objDB["volume_max"],
                );
                // ultimo volume memorizzato (attributo di stato)
                $objSmartTV->volume = $objDB["volume"];
                // aggiunge l'istanza di SmartTV all'array
                $arraySmartTV[] = $objSmartTV;
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $arraySmartTV;
    }


    /**
     * Restituisce un'istanza di SmartTV con il numero seriale specificato
     * @param string $numeroSeriale Numero seriale per cui cercare
     * @return null|SmartTv Istanza di SmartTV individuata oppure null se non trovata
     */
    public static function estrai(string $numeroSeriale): ?SmartTv {
        $objSmartTV = null;
        try {
            // crea una istanza di database che fa rifeirmento alla directory specificata
            $db = new JSONDB(self::$directoryDB);
            // estrae tutte tutti gli elementi dal database con nome file smart_tvs.json
            $arrayDB = $db->select( '*' )
            	->from( self::$fileName )
                ->where( [ 'numero_seriale' => $numeroSeriale ] )
                ->get();
            // ci deve essere un unico risultato
            foreach ($arrayDB as $objDB) {
                $objSmartTV = new SmartTv(
                    $objDB["marca"],
                    $objDB["modello"],
                    $objDB["numero_seriale"],
                    $objDB["diagonale"],
                    $objDB["volume_max"],
                );
                // ultimo volume memorizzato (attributo di stato)
                $objSmartTV->volume = $objDB["volume"];
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $objSmartTV;
    }


    /**
     * Inserisce nel DB l'istanza di SmartTV specificata
     * @param SmartTv $objSmartTV Istanza da inserire
     * @return bool Risultato dell'operazione: true = successo, false = fallimento
     */
    public static function inserisci(SmartTv $objSmartTV): bool {
        $operazioneRiuscita = false;
        try {
            // crea un database che sarà memorizzato nella stessa directory di questo file (modificare per altra cartella)
            $db = new JSONDB(self::$directoryDB);
            // crea il file smart_tvs.json se non esiste ed inserisce un oggetto con i dati specificati
            $db->insert( 
                self::$tableName, 
                [
                    'marca' => $objSmartTV->marca,
                    'modello' => $objSmartTV->modello,
                    'numero_seriale' => $objSmartTV->numero_seriale,
                    'diagonale' => $objSmartTV->diagonale,
                    'volume_max' => $objSmartTV->volume_max,
                    'volume' => $objSmartTV->volume
                ]
            );
            $operazioneRiuscita = true;
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $operazioneRiuscita;
    }


    /**
     * Aggiorna nel DB l'istanza di SmartTV specificata
     * @param SmartTv $objSmartTV Istanza da aggiornare
     * @return bool Risultato dell'operazione: true = successo, false = fallimento
     */
    public static function aggiorna(SmartTv $objSmartTV): bool {
        $operazioneRiuscita = false;
        try {
            // crea un database che sarà memorizzato nella stessa directory di questo file (modificare per altra cartella)
            $db = new JSONDB(self::$directoryDB);
            // crea il file smart_tvs.json se non esiste ed inserisce un oggetto con i dati specificati
            $db->update( [ 
                'marca' => $objSmartTV->marca,
                'modello' => $objSmartTV->modello,
                // IPOTESI: NUMERO SERIALE IMMUTABILE  'numero_seriale' => $objSmartTV->numero_seriale,
                'diagonale' => $objSmartTV->diagonale,
                'volume_max' => $objSmartTV->volume_max,
                'volume' => $objSmartTV->volume
            ] )
            ->from( self::$fileName )
            ->where( [ 'numero_seriale' => $objSmartTV->numero_seriale ] )
            ->trigger();
            $operazioneRiuscita = true;
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $operazioneRiuscita;
    }



    /**
     * Elimina dal DB l'istanza di SmartTV con il numero serale specificato
     * @param string $numeroSeriale Numero seriale della istanza da eliminare
     * @return bool Risultato dell'operazione: true = successo, false = fallimento
     */
    public static function elimina(string $numeroSeriale): bool {
        $operazioneRiuscita = false;
        try {
            // crea un database che sarà memorizzato nella stessa directory di questo file (modificare per altra cartella)
            $db = new JSONDB(self::$directoryDB);
            // crea il file smart_tvs.json se non esiste ed inserisce un oggetto con i dati specificati
            $db->delete()
                ->from( self::$fileName )
                ->where( [ 'numero_seriale' => $numeroSeriale ] )
                ->trigger();
            $operazioneRiuscita = true;
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $operazioneRiuscita;
    }
}
?>