<?php
class Api{
    private $connect='';
    function __construct()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=tortasdb","root","");
    }

    function list(){
        try {
            $query="select * from tortas";
            $sql = $this->connect->prepare($query);
            $ok= $sql->execute();
            if($ok){
                $data=null;
                while($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] = $row;
                }
                $datasuccess=[
                    'status'=>200,
                    'data'=>$data
                ];
                return $datasuccess;
            }
            else{
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }

    function insert(){
        try {
            $query="insert into tortas (nombre,descripcion,precio) values(:pNombre,:pDescripcion,:pPrecio)";
            $sql = $this->connect->prepare($query);
            $sql->bindParam(':pNombre',$_POST['nombre'],PDO::PARAM_STR);
            $sql->bindParam(':pDescripcion',$_POST['descripcion'],PDO::PARAM_STR);
            $sql->bindParam(':pPrecio',$_POST['precio'],PDO::PARAM_INT);
            $ok= $sql->execute();
            if($ok){
                $datasuccess=[
                    'status'=>200
                ];
                return $datasuccess;
            }
            else{
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }
}
?>