<?php
/**
 * Clase que envuelve una instancia de la clase PDO
 * para el manejo de la base de datos
 */
  if (!isset($_SESSION) ) { session_start(); }
require_once  "jq-config.php";
class DatabaseConnection{
    /**
     * Única instancia de la clase
     */
    private static $db=null;
    /**
     * Instancia de PDO
     */
    private static $pdo;
    
    final private function __construct(){
        try{
            // creas nueva conexion PDO
            self::getDb();
        }catch(PDOException $e){
            // Manejo de excepciones
        }
    }
    /**
     * Retorna en la única instancia de la clase
     * @return DatabaseConnection|null
     */
	public static function getInstance(){
		if(self::$db==null){
			self::$db=new self();
		}
		return self::$db;
	}
	/**
     * Crear una nueva conexión PDO basada
     * en los datos de conexión
     * @return PDO Objeto PDO
     */
	public function getDb(){
        if (self::$pdo == null) {
            self::$pdo = new PDO(
                DB_DSN,
                DB_USER,
                DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            //Habilitar excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
	/**
     * Evita la clonación del objeto
     */
	final protected function __clode(){}
	function _destructor(){
		self::$pdo=null;
	}
}
?>