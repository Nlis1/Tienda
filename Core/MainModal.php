<?php

require_once(__DIR__ . '/./Conexion.php');
class MainModal{
    public $conexion;
   public function __construct(){
        $this->conexion= Conexion::conectar();
    }
    
    public function generarCodigo($letra,$longitud) {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $codigo = '';
        $max = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[random_int(0, $max)];
        }

        return $letra . $codigo;
    }

    
    protected function encryption($string){   
        $output=FALSE;
        $key=hash('sha256', '$BP@2025');
        $iv=substr(hash('sha256', '261905'), 0, 16);
        $output=openssl_encrypt($string, 'AES-256-CBC', $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }

    protected static function decryption($string){
        $key=hash('sha256', '$BP@2025');
        $iv=substr(hash('sha256', '261905'), 0, 16);
        $output=openssl_decrypt(base64_decode($string), 'AES-256-CBC', $key, 0, $iv);
        return $output;
    }
}