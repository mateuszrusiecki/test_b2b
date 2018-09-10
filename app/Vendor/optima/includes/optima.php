<?php
/**
 * Rozwiazanie integracyjne Comarch ERP Optima <-> FEB B2B
 *
 * (C) 2015 Klim Baron Business Solutions Sp. z o.o. Wszelkie prawa zastrzezone.
 */

class Optima
{
    // sciezka do plikow *.sql z szablonami zapytan

    // dane dostepowe do bazy danych Comarch ERP Optima
    //public $optima_sqlsrv_host = "192.168.231.15\OPTIMA"; jesli wywala błąd to można bez nazwy: $optima_sqlsrv_host = "192.168.0.226"; 
    public $optima_sqlsrv_host = "OPTIMA\OPTIMA";
    public $optima_sqlsrv_options = array(
        "Database" => "CDN_feb",
        "UID" => "sa",
        "PWD" => "Comarch!2011",
        "ConnectionPooling" => false,
    );
    
	protected $connection = false;

	private function showErrors()
	{
		if ( ($errors = sqlsrv_errors() ) != null ) {
			foreach ($errors as $error) {
				echo "SQLSTATE: ".$error['SQLSTATE']."\n";
				echo "code: ".$error['code']."\n";
				echo "message: ".$error['message']."\n";
			}
		}
	}

	public function __destruct()
	{
		if ($this->connection)
			sqlsrv_close( $this->connection );
	}

    /*
     * brak opisu co ta funkcja robi...
     */
	public function loadSql($file, $params = array())
	{
		$data = file_get_contents( dirname(__FILE__)."/sql/$file" );

		if (!$data)
			throw new Exception( "file $file not found" );

		foreach ($params as $key => $value)
			$data = str_replace("{".$key."}", $value, $data);

		return str_replace(array("\n", "\r", "\t"), " ", $data);
	}

	public function connect()
	{

		$this->connection = sqlsrv_connect( $this->optima_sqlsrv_host, $this->optima_sqlsrv_options );

		if (!$this->connection) {
			$this->showErrors();
			//throw new Exception( "cannot connect to sql server" );
		} else{
            debug($this->connection);
        }
	}

	public function begin()
	{
		if (!$this->connection)
			throw new Exception( "not connected to sql server" );

		$result = sqlsrv_begin_transaction( $this->connection );

		if ( $result === false )
			throw new Exception( "sql server transaction begin error" );
	}

	public function commit()
	{
		if (!$this->connection)
			throw new Exception( "not connected to sql server" );

		$result = sqlsrv_commit( $this->connection );

		if ( $result === false )
			throw new Exception( "sql server transaction commit error" );
	}

	public function rollback()
	{
		if (!$this->connection)
			throw new Exception( "not connected to sql server" );

		$result = sqlsrv_rollback( $this->connection );

		if ( $result === false )
			throw new Exception( "sql server transaction rollback error" );
	}

	private function decodeDate($value)
	{
		$date = $value->format(DateTime::RFC3339);
		return substr($date, 0, 10);
		// $sub = substr($date, 0, 19);
		// return str_replace("T", " ", $sub);
	}

	public function query($sql, $params = array())
	{
		if (!$this->connection)
			throw new Exception( "not connected to sql server" );

		$iso = array();
		foreach ($params as $key => $value)
			$iso[$key] = iconv("UTF-8", "Windows-1250", $value);
		
		$result = sqlsrv_query( $this->connection, $sql, $iso );
		$out = array();

		if ( $result === false ) {
			$this->showErrors();
			throw new Exception( "sql server query error" );
		}

		while ( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {
			foreach ($row as $key => $value)
				if (is_object($value))
					$row[$key] = $this->decodeDate($value);
				else if (strpos($value, ".") === 0 && is_numeric("0".$value))
					$row[$key] = "0".$value;
				else
					$row[$key] = iconv("Windows-1250", "UTF-8", $value);
			$out[] = $row;
		}
        
		sqlsrv_free_stmt( $result );
		return $out;
	}

	public function execute($sql, $params = array())
	{
		if (!$this->connection)
			throw new Exception( "not connected to sql server" );

		$result = sqlsrv_query( $this->connection, $sql, $params );

		if ( $result === false ) {
			$this->showErrors();
			throw new Exception( "sql server query error" );
		}

		sqlsrv_free_stmt( $result );
	}

	function insert($table, $fields)
	{
		global $optima_charset;

		$this->execute("SET ANSI_WARNINGS ON");
		$this->execute("SET ANSI_PADDING ON");
		$this->execute("SET ANSI_NULLS ON");
		$this->execute("SET QUOTED_IDENTIFIER ON");
		$this->execute("SET CONCAT_NULL_YIELDS_NULL ON");
		$this->execute("SET ARITHABORT ON");

		$cols = array();
		$vals = array();
		$params = array();

		foreach ($fields as $key => $value) {
			$cols[] = $key;
			$vals[] = "?";
			$params[] = is_null($value) ? null : iconv("UTF-8", "Windows-1250", $value);
		}

		$listCol = implode(",", $cols);
		$listVal = implode(",", $vals);

		$sql = "insert into $table ($listCol) values ($listVal)";
		$this->execute($sql, $params);

		$sql = "select @@identity as lastid";
		$rows = $this->query($sql);
		return $rows[0]["lastid"];
	}
    
    
//    function pobierzKontrahenta($kod)
//    {
//        global $atrybut_numer_projektu;
//
//        $sql = $this->loadSql("kontrahent.sql", array(
//            "kod" => $kod,
//            "atrybut" => $atrybut_numer_projektu,
//        ));
//        $rows = $this->query($sql, array());
//        return empty($rows) ? false : $rows[0];
//    }
    
}
