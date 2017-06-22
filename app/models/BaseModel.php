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
	
	
}
