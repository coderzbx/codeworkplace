<?php
/**
* ���ݿ����ӷ�װ
*/
class Db {
	// �洢���ʵ���ľ�̬��Ա����
	static private $_instance;
	// ���ݿ����Ӿ�̬����
	static private $_connectSource;
	// �������ݿ�����
	private $_dbConfig = array(
		'host' => '127.0.0.1',
		'user' => 'root',
		'password' => '',
		'database' => 'cms',
	);

	private function __construct() {
	}
	
	/**
	 * ʵ����
	*/
	static public function getInstance() {
		// �ж��Ƿ�ʵ����
		// ����ʵ���Ĺ����ľ�̬����
		if(!(self::$_instance instanceof self)) {
		//���������$_instance�Ƿ��Ǳ����ʵ��
		//selfָ���Ǳ���
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	* ���ݿ�����
	*/
	public function connect() {
		if(!self::$_connectSource) {
			// ���ݿ�����
			self::$_connectSource = @mysql_connect($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password']);	
			//@����Ϊ��ֹ�������

			if(!self::$_connectSource) {
				// �׳��쳣����
				throw new Exception('mysql connect error ');
			}
			// ѡ��һ�����ݿ�
			mysql_select_db($this->_dbConfig['database'], self::$_connectSource);
			// �����ַ�����
			mysql_query("set names UTF8", self::$_connectSource);
		}
		// ������Դ����
		return self::$_connectSource;
	}
	
}

//test
/**
$connect = Db::getInstance()->connect();

$sql = "select * from ����";
$result = mysql_query($sql,$connect);
echo mysql_num_rows($result);
var_dump($result);
*/
