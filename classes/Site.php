<?php
    class Site{
        
        /*public static function updateUsuarioOnline(){
            if(isset($_SESSION['online'])){
                $token = $_SESSION['online'];
                $horaAtual = date('Y-m-d H:i:s');
                $check = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
                $check->execute(array($token));
                if($check->rowCount() == 1){
                    $sql = MySql::connect()->prepare('UPDATE `tb_admin.online` SET ultima_acao = ? WHERE token = ?');
                    $sql->execute(array($horaAtual,$token));
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SESSION['online'];
                    $horaAtual = date('Y-m-d H:i:s');
                    $sql = MySql::connect()->prepare('INSERT INTO `tb_admin.online` VALUE(null,?,?,?)');
                    $sql->execute(array($ip,$horaAtual,$token));
                }                
            }else{
                $_SESSION['online'] = uniqid();
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $horaAtual = date('Y-m-d H:i:s');
                $sql = MySql::connect()->prepare('INSERT INTO `tb_admin.online` VALUE(null,?,?,?)');
                $sql->execute(array($ip,$horaAtual,$token));
            }
        }
        public static function listarUsuaruosOnline(){
            self::limparUsuariosOnline();
            $sql = Mysql::connect()->prepare("SELECT * FROM `tb_admin.online`");
            $sql->execute();
            return $sql->fetchAll();
        }
        public static function limparUsuariosOnline(){
            $date = date('Y-m-d H:i:s');
            $sql = MySql::connect()->exec("DELETE FROM `tb_admin.online` WHERE `ultima_acao` < '$date' - INTERVAL 1 MINUTE");
        }
        public static function contador(){
            if(!isset($_COOKIE['visita'])){
                //expira acada sete dias
                setcookie('visita','true',time()+(60*60*24));
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visitas` VALUE (null,?,?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
            }
        }*/
    }
?>