<?php 

require_once(__DIR__ . '/../Core/Conexion.php');
require_once(__DIR__ . '/../Models/UserModel.php');

class LoginController extends MainModal {
    public $conexion, $model;
    public function __construct(){
        $this->conexion= Conexion::conectar();
        $this->model = new UserModel();
    }

    public function register(){
        $name=$_POST['name'];
        $last_name=$_POST['lastName'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $gender=$_POST['optionsGenero'];
        $password=$_POST['password'];

        if(!empty($email)){
            $sql="SELECT email FROM users WHERE email='$email'";
            $resultado=$this->conexion->query($sql);
            if($resultado && $resultado->fetch_assoc()){
                 echo '<script type="text/javascript">
                        alert("El email ya esta registraod en el sistema");
                        window.location.href="http://localhost/tienda/Views/register.php"
                    </script>';
            }
        }

            $clave=MainModal::encryption($password);

            $datos=[
                "name"=>$name,
                "last_name"=>$last_name,
                "email"=>$email,
                "address"=>$address,
                "phone"=>$phone,
                "password"=>$clave,
                "gender"=>$gender
            ];

                var_dump("entro");

    
            $user_id =$this->model->register_user($datos);

            if($user_id ){
                //asignar el rol del usuario
                var_dump($user_id);
                $sql= "SELECT id FROM roles WHERE name='cliente'";
                $response=$this->conexion->query($sql);
                if($response && $rowRol = $response->fetch_assoc()){
                    $rolCliente= $rowRol['id'];

                    $sql="INSERT INTO rol_user (user_id, rol_id) VALUES(?,?)";
                    $stmt=$this->conexion->prepare($sql);
                    $stmt->bind_param("ss", $user_id, $rolCliente);
                    $stmt->execute();
                }

                $url="http://localhost/tienda/Views/login.php";
                echo '<script type="text/javascript">
                        alert("Usuario registrado correctamente");
                        window.location.href="'.$url.'";
                      </script>';
                return $url;
            }else{
                echo '<script type="text/javascript">
                        alert("No se pudo registrar correctamente");
                         window.location.href="http://localhost/tienda/Views/register.php";
                      </script>';
                }
            
    }

     public function iniciar_sesion(){
        $email=$_POST['email'];
        $clave=$_POST['password'];

        $password=MainModal::encryption($clave);

        $datosLogin = [
            "email"=>$email,
            "password"=>$password
        ];
        $user=$this->model->validate_credentials($datosLogin);
        if($user){
            session_start();
            $userId=$user['id'];
            $_SESSION['nombre'] = $user['name'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['apellido'] = $user['last_name'];

            $sql = "SELECT rol_id FROM rol_user WHERE user_id='$userId'";
            $response = $this->conexion->query($sql);
            if ($response && $rowRol = $response->fetch_assoc()) {
                $rol = $rowRol['rol_id'];
                $_SESSION['cliente'] = $rol;
                if($rol==="1"){
                    $url="http://localhost/tienda/index.php";
                    $urlLocation='<script> window.location="'.$url.'"</script>';
                    return $urlLocation;
                }else if($rol==="2"){
                    $_SESSION['admin'] = $rol;
                    $url="http://localhost/tienda/Views/products.php";
                    $urlLocation='<script> window.location="'.$url.'"</script>';
                    return $urlLocation;
                }
            }
        }else{
            $url="http://localhost/tienda/Views/login.php";
                echo '<script type="text/javascript">
                        alert("El usuario o la contraseña son incorrectas.");
                        window.location.href="'.$url.'";
                      </script>';
                return $url;
        }

    }
}
