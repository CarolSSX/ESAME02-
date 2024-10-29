<?php

namespace MieClassi;

/**
 * Questa classe contiene tutti i metodi utili per il mio sito web, commentati e documentati
 * @author Carol Sassano
 * @copyright 2024
 * @version 1.0
 * @license LGPL
 *
 */

class Utilities
{
    //FILE JSON LETTURA E DECODIFICA
    /**
     * @param string $filepath
     * @return array|null 
     */
    public static function loadJSON($filepath)
    {
        if (file_exists($filepath)) {
            $jsonContent = file_get_contents($filepath);
            return json_decode($jsonContent, true);
        }
        return null;
    }
    //-----------------------------------------------------------------------------------------------------

    //POST REQUEST PER IL FORM
    /**
     * Ottiene i dati del modulo POST per un campo specifico
     *
     * @param string $field 
     * @return mixed|null Il valore del campo se esiste, altrimenti null
     */

    public static function getFormData($field)
    {
        return isset($_POST[$field]) ? $_POST[$field] : null;
    }
    //-----------------------------------------------------------------------------------------------------

    //DA FORM A FILE JSON 
    /**
     * Scrive i dati in formato JSON in un file.
     *
     * @param string $file 
     * @param array $dati 
     * @param bool $commenta Se true stampa un messaggio 
     * @param bool $fileContent Controlla l'esistenza del file e il suo contenuto
     * @return bool Restituisce true se la scrittura ha avuto successo
     */
    public static function scritturaDataJson($file, $dati, $commenta = false)
    {
        // Controlla se il file esiste già e ha contenuto JSON
        $fileContent = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        if (!is_array($fileContent)) {
            $fileContent = [];  // E' un array vuoto?
        }

        $fileContent[] = $dati;
        $jsonContent = json_encode($fileContent, JSON_PRETTY_PRINT);

        // Scrittura dei dati in formato JSON nel file
        if (file_put_contents($file, $jsonContent) !== false) {
            if ($commenta) {
                echo "Data saved successfully!";
            }
            return true;
        } else {
            echo "Ops! An error has occurred!";
            return false;
        }
    }
}
