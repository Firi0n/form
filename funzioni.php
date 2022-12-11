<?php
    //Classe per la gestione semplificata delle zone.
    class Zona{
        //Url dell'API, chiave e valore da prendere nel metodo chiamata API, booleano per la stampa.
        private string $url;
        private string $key;
        private string $value;
        private bool $print;
        //Costruttore.
        public function __construct(string $url, string $key = 'geonameId', string $value = 'name', bool $print = true){

            require 'APIkey.php';
            $this->url = $url.'lang=it&username=' . $APIkey;
            $this->key = $key;
            $this->value = $value;
            $this->print = $print;
        }
        //Metodi get.
        public function getUrl(){
            return $this->url;
        }
        public function getKey(){
            return $this->key;
        }
        public function getValue(){
            return $this->value;
        }
        public function getPrint(){
            return $this->print;
        }
        //Metodo per la chiamata all'API.
        function chiamataAPIbase(){
            //Chiamata all'API
            $rispostaAPI = file_get_contents($this->getUrl());
            //Decodifica del JSON
            $rispostaAPI = json_decode($rispostaAPI, true);
            return $rispostaAPI;
        }
        //Metodo per la semplificazione dell'array restituito dal metodo chiamataAPIbase.
        function chiamataAPI(){
            $rispostaAPI = $this->chiamataAPIbase();
            $risposta = array();
            //Ciclo per la creazione dell'array
            foreach ($rispostaAPI['geonames'] as $value) {
                $risposta[$value[$this->getKey()]] = $value[$this->getValue()];
            }
            //Ordinamento dell'array
            asort($risposta);
            //Ritorno dell'array
            return $risposta;
        }
    }

    //Funzione che restituisce il nome di una zona partendo dal geonameId (scelta del geonameId come key obbligata per il corretto funzionamento dell'API).
    function getName($geonameId){
        //Creazione di un oggetto Zona apposito.
        $select = new Zona('http://api.geonames.org/getJSON?geonameId=' . $geonameId . '&');
        //Chiamata al metodo chiamataAPIbase.
        $rispostaAPI = $select->chiamataAPIbase();
        //Ritorno del nome.
        return $rispostaAPI['name'];
    }

?>
