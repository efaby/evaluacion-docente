<?php
class BaseModel {
	private $pdo;
	private function openConexion() {
		try {
			$this->pdo = new PDO ( 'mysql:host=' . HOSTNAME_DATABASE . ';dbname=' . DATABASE . ';charset=utf8', USERNAME, PASSWORD );
			$this->pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
	}
	private function closeConexion() {
		$this->pdo = null;
	}
	public function execSql($sql, $parameters, $list = false, $obtainId = false) {
		try {
			$this->openConexion ();
			$stm = $this->pdo->prepare ( $sql );
			$stm->execute ( $parameters );
			if ($obtainId) {
				$result = $this->pdo->lastInsertId ();
			} else {
				if ($list) {
					$result = $stm->fetchAll ( PDO::FETCH_OBJ );
				} else {
					$result = $stm->fetch ( PDO::FETCH_OBJ );
				}
			}
			$this->closeConexion ();
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
		return $result;
	}
	public function getCatalogo($tabla, $where = null) {
		$sql = "Select * from " . $tabla . $where;
		return $this->execSql ( $sql, array (), true );
	}
	public function saveDatos($objeto, $tabla) {
		$id = $objeto ["id"];
		unset ( $objeto ["id"] );
		$values = "";
		$keys = "";
		$usuarioData = array ();
		foreach ( $objeto as $key => $value ) {
			if ($id == 0) {
				$values .= ($values == '') ? "?" : " ,?";
				$keys .= ($keys == '') ? $key : ' ,' . $key;
			} else {
				$values .= ($values == '') ? $key . " = ?" : " ," . $key . " = ?";
			}
			$usuarioData [] = $value;
		}
		
		if ($id == 0) {
			$sql = ' Insert into ' . $tabla . ' (' . $keys . ') values (' . $values . ')';
		} else {
			$sql = 'Update ' . $tabla . ' set ' . $values . ' where id = ?';
			$usuarioData [] = $id;
		}
		return $this->execSql ( $sql, $usuarioData, false, true );
	}
	public function saveMultipleData($fieldsGeneral, $general, $fieldsListado, $listado) {
		$this->openConexion ();
		try {
			
			$this->pdo->beginTransaction ();
			
			$args = array_fill ( 0, count ( $general ), '?' );
			$sql = "INSERT INTO confronta_general (" . implode ( ',', ($fieldsGeneral) ) . ") VALUES (" . implode ( ',', $args ) . ")";
			$stm = $this->pdo->prepare ( $sql );
			$stm->execute ( $general );
			$result = $this->pdo->lastInsertId ();
			$args = array_fill ( 0, count ( $listado [0] ) + 1, '?' );
			$sql = "INSERT INTO confronta (" . implode ( ',', ($fieldsListado) ) . ") VALUES (" . implode ( ',', $args ) . ")";
			$stm = $this->pdo->prepare ( $sql );
			
			foreach ( $listado as $row ) {
				$row [] = $result;
				$stm->execute ( $row );
			}
			$this->pdo->commit ();
		} catch ( PDOException $ex ) {
			$this->pdo->rollBack ();
			die ( $ex->getMessage () );
		}
		
		$this->closeConexion ();
	}
	public function updateMultipleData($fieldsGeneral, $general, $fieldsListado, $listado, $confrontaId) {
		$this->openConexion ();
		try {
			
			$this->pdo->beginTransaction ();
			
			$fields = implode ( ' = ? ,', $fieldsGeneral ) . ' = ?';
			$sql = "Update confronta_general SET " . $fields . " where id = ?";
			$stm = $this->pdo->prepare ( $sql );
			$general [] = $confrontaId;
			$stm->execute ( $general );
			unset ( $fieldsListado [11] );
			$fields = implode ( ' = ? ,', $fieldsListado ) . ' = ?';
			$sql = "Update confronta SET " . $fields . " where confronta_general_id = ? and persona_id = ?";
			
			$stm = $this->pdo->prepare ( $sql );
			
			foreach ( $listado as $row ) {
				$row [] = $confrontaId;
				$row [] = $row [0];
				$stm->execute ( $row );
			}
			$this->pdo->commit ();
		} catch ( PDOException $ex ) {
			$this->pdo->rollBack ();
			die ( $ex->getMessage () );
		}
		
		$this->closeConexion ();
	}
	public function deleteMultipleData($confrontaId) {
		$this->openConexion ();
		try {
			
			$this->pdo->beginTransaction ();
			
			$sql = "delete from confronta where confronta_general_id = ?";
			$stm = $this->pdo->prepare ( $sql );
			$stm->execute ( array (
					$confrontaId 
			) );
			
			$sql = "delete from confronta_general where id = ?";
			$stm = $this->pdo->prepare ( $sql );
			$stm->execute ( array (
					$confrontaId 
			) );
			
			$this->pdo->commit ();
		} catch ( PDOException $ex ) {
			$this->pdo->rollBack ();
			die ( $ex->getMessage () );
		}
		
		$this->closeConexion ();
	}
	public function backupDataBase() {
		require_once (PATH_HELPERS . "/sbmd/backupmysql.class.php");
		$lang = 'en';
		$target_path = PATH_FILES . 'respaldos/';
		$conn_data = [ 
				'host' => HOSTNAME_DATABASE,
				'user' => USERNAME,
				'pass' => PASSWORD,
				'dbname' => DATABASE
		];
		
		$bk = new backupmysql ( $lang, $dir );
		$bk->setMysql ( $conn_data ); 
		$tables = $bk->getTables (); 
		                            
		if ($bk->error === false) {
			$bk_sql = (count ( $tables ) > 0) ? $bk->saveBkZip ( $tables ) : 'No tables in database';			
			$bk->getZipFile ( $bk_sql );
			echo $bk->delFile ( $bk_sql );
		} else
			echo $bk->error;
	}
}
