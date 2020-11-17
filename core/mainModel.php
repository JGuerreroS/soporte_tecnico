<?php
    require_once 'configAPP.php';

    class mainModel{

        // Conexión 1
        protected function conectar(){

            try {
                
                $conexion = new PDO(SGBD,DBUSER,DBPASS);
                return $conexion;
                // echo "Conectado";
            } catch (PDOException $e) {
                
                die($e->getMessage());
                
            }finally{
                
                $conexion = NULL;
                
            }

        }

        // Conexión 2
        protected function conn(){

            try {
                
                $conexion = new PDO(SGBD2,DBUSER2,DBPASS2);
                return $conexion;
                // echo "Conectado";
            } catch (PDOException $e) {
                
                die($e->getMessage());
                
            }finally{
                
                $conexion = NULL;
                
            }

        }

        protected function encriptar($string){

            $output = false;
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;

        }

        protected function desencriptar($string){

            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
            return $output;
            
        }

        protected function generar_codigo_aleatorio($letra, $longitud, $num){

            for ($i=1; $i<=$longitud ; $i++){

                $numero = rand(0,9);
                $letra.= $numero;
            }

            return $letra.'-'.$num;

        }

        protected function limpiar_cadena($string){

            $string = trim($string);
            $string = stripslashes($string);
            $string = str_ireplace('<script>', '', $string);
            $string = str_ireplace('</script>', '', $string);
            $string = str_ireplace('<script src', '', $string);
            $string = str_ireplace('<script type=', '', $string);
            $string = str_ireplace('SELECT * FROM', '', $string);
            $string = str_ireplace('INSERT INTO', '', $string);
            $string = str_ireplace('DELETE FROM', '', $string);
            $string = str_ireplace('--', '', $string);
            $string = str_ireplace('^', '', $string);
            $string = str_ireplace('[', '', $string);
            $string = str_ireplace(']', '', $string);
            $string = str_ireplace('==', '', $string);
            $string = str_ireplace(';', '', $string);

            return $string;

        }

    }