<?php

require_once(__DIR__ . '/./Conexion.php');
class MainModal{

    protected function sweet_alert($datos){
        $icon = $datos['Tipo']; // success, error, warning...
        $title = $datos['Titulo'];
        $text = $datos['Texto'];
    
        if($datos['Alerta'] == "simple"){
            $alerta = "
            <script>
                Swal.fire({
                    title: '$title',
                    text: '$text',
                    icon: '$icon'
                });
            </script>";
        } elseif($datos['Alerta'] == "recargar"){
            $alerta = "<script>
                Swal.fire({
                    title: '$title',
                    text: '$text',
                    icon: '$icon',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    location.reload();
                });
            </script>";
        } elseif($datos['Alerta'] == "limpiar"){
            $alerta = "<script>
                Swal.fire({
                    title: '$title',
                    text: '$text',
                    icon: '$icon',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    document.querySelector('.FormularioAjax').reset();
                });
            </script>";
        }
    
        return $alerta;
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