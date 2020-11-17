<?php
// Conexión 1---------------------------------------------------------------------------------------------------------------------
const SERVER = "192.168.8.144 options='--client_encoding=UTF8'";
const DBNAME = 'soporte_tecnico';
const DBUSER = 'postgres';
const DBPASS = '1qaz2wsx';
const DBPORT = 5432; // Solo para base de datos PostgreSQL
// Para Bases de datos MySQL
// const SGBD = 'mysql:host='.SERVER.';dbname='.DBNAME;
// Para Bases de datos PostgreSQL
const SGBD = 'pgsql:host='.SERVER.';port='.DBPORT.';dbname='.DBNAME;

/* Constantes para el modo de encriptación de las contraseñas */
// No modificar
const METHOD = 'AES-256-CBC';
// Colocar aquí las iniciales del sistema, incluir algunos simbolos, esto antes de registrar una cuenta de usuario en la base de datos, luego de registrar algo, no se puede modificar esta constante, ya que si se hace, no se podra recuperar el valor de la contraseña encriptada
const SECRET_KEY = '$SW@001';
// Colocar solo números, cualquier valor, esto antes de registrar una cuenta de usuario en la base de datos, luego de registrar algo, no se puede modificar esta constante, ya que si se hace, no se podra recuperar el valor de la contraseña encriptada
const SECRET_IV = '151519';

// Conexión 2---------------------------------------------------------------------------------------------------------------------
const SERVER2 = "192.168.8.10 options='--client_encoding=UTF8'";
const DBNAME2 = "sigefirrhh";
const DBUSER2 = "postgres";
const DBPASS2 = "1qaz2wsx";
const DBPORT2 = 5432; // Solo para base de datos PostgreSQL
// Para Bases de datos MySQL
// const SGBD = 'mysql:host='.SERVER.';dbname='.DBNAME;
// Para Bases de datos PostgreSQL
const SGBD2 = 'pgsql:host='.SERVER2.';port='.DBPORT2.';dbname='.DBNAME2;