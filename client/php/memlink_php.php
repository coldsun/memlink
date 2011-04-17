<?php

/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 * 
 * This file is not intended to be easily readable and contains a number of 
 * coding conventions designed to improve portability and efficiency. Do not make
 * changes to this file unless you know what you are doing--modify the SWIG 
 * interface file instead. 
 * ----------------------------------------------------------------------------- */

// Try to load our extension if it's not already loaded.
if (!extension_loaded('memlink')) {
  if (strtolower(substr(PHP_OS, 0, 3)) === 'win') {
    if (!dl('php_memlink.dll')) return;
  } else {
    // PHP_SHLIB_SUFFIX gives 'dylib' on MacOS X but modules are 'so'.
    if (PHP_SHLIB_SUFFIX === 'dylib') {
      if (!dl('memlink.so')) return;
    } else {
      if (!dl('memlink.'.PHP_SHLIB_SUFFIX)) return;
    }
  }
}


/*
abstract class memlink {
	const MEMLINK_ERR_CLIENT = MEMLINK_ERR_CLIENT;

	const MEMLINK_ERR_SERVER = MEMLINK_ERR_SERVER;

	const MEMLINK_ERR_SERVER_TEMP = MEMLINK_ERR_SERVER_TEMP;

	const MEMLINK_ERR_CLIENT_CMD = MEMLINK_ERR_CLIENT_CMD;

	const MEMLINK_ERR_NOKEY = MEMLINK_ERR_NOKEY;

	const MEMLINK_ERR_EKEY = MEMLINK_ERR_EKEY;

	const MEMLINK_ERR_CONNECT = MEMLINK_ERR_CONNECT;

	const MEMLINK_ERR_RETCODE = MEMLINK_ERR_RETCODE;

	const MEMLINK_ERR_NOVAL = MEMLINK_ERR_NOVAL;

	const MEMLINK_ERR_MEM = MEMLINK_ERR_MEM;

	const MEMLINK_ERR_MASK = MEMLINK_ERR_MASK;

	const MEMLINK_ERR_PACKAGE = MEMLINK_ERR_PACKAGE;

	const MEMLINK_ERR_REMOVED = MEMLINK_ERR_REMOVED;

	const MEMLINK_ERR_RANGE_SIZE = MEMLINK_ERR_RANGE_SIZE;

	const MEMLINK_ERR_SEND = MEMLINK_ERR_SEND;

	const MEMLINK_ERR_RECV = MEMLINK_ERR_RECV;

	const MEMLINK_ERR_TIMEOUT = MEMLINK_ERR_TIMEOUT;

	const MEMLINK_ERR_KEY = MEMLINK_ERR_KEY;

	const MEMLINK_ERR_PARAM = MEMLINK_ERR_PARAM;

	const MEMLINK_ERR_IO = MEMLINK_ERR_IO;

	const MEMLINK_ERR_LIST_TYPE = MEMLINK_ERR_LIST_TYPE;

	const MEMLINK_ERR_RECV_BUFFER = MEMLINK_ERR_RECV_BUFFER;

	const MEMLINK_ERR_CLIENT_SOCKET = MEMLINK_ERR_CLIENT_SOCKET;

	const MEMLINK_ERR_CONN_PORT = MEMLINK_ERR_CONN_PORT;

	const MEMLINK_ERR_RECV_HEADER = MEMLINK_ERR_RECV_HEADER;

	const MEMLINK_ERR_CONNECT_READ = MEMLINK_ERR_CONNECT_READ;

	const MEMLINK_ERR_CONNECT_WRITE = MEMLINK_ERR_CONNECT_WRITE;

	const MEMLINK_ERR_NOACTION = MEMLINK_ERR_NOACTION;

	const MEMLINK_ERR_PACKAGE_SIZE = MEMLINK_ERR_PACKAGE_SIZE;

	const MEMLINK_ERR_CONN_LOST = MEMLINK_ERR_CONN_LOST;

	const MEMLINK_ERR = MEMLINK_ERR;

	const MEMLINK_FAILED = MEMLINK_FAILED;

	const MEMLINK_OK = MEMLINK_OK;

	const MEMLINK_TRUE = MEMLINK_TRUE;

	const MEMLINK_FALSE = MEMLINK_FALSE;

	const MEMLINK_ERR_DUMP_SIZE = MEMLINK_ERR_DUMP_SIZE;

	const MEMLINK_ERR_DUMP_VER = MEMLINK_ERR_DUMP_VER;

	const MEMLINK_REPLIED = MEMLINK_REPLIED;

	const ROLE_MASTER = ROLE_MASTER;

	const ROLE_SLAVE = ROLE_SLAVE;

	const SYNCLOG_INDEXNUM = SYNCLOG_INDEXNUM;

	const MEMLINK_TAG_DEL = MEMLINK_TAG_DEL;

	const MEMLINK_TAG_RESTORE = MEMLINK_TAG_RESTORE;

	const CMD_GETDUMP_OK = CMD_GETDUMP_OK;

	const CMD_GETDUMP_CHANGE = CMD_GETDUMP_CHANGE;

	const CMD_GETDUMP_SIZE_ERR = CMD_GETDUMP_SIZE_ERR;

	const CMD_SYNC_OK = CMD_SYNC_OK;

	const CMD_SYNC_FAILED = CMD_SYNC_FAILED;

	const CMD_RANGE_MAX_SIZE = CMD_RANGE_MAX_SIZE;

	const HASHTABLE_BUNKNUM = HASHTABLE_BUNKNUM;

	const HASHTABLE_MASK_MAX_BIT = HASHTABLE_MASK_MAX_BIT;

	const HASHTABLE_MASK_MAX_BYTE = HASHTABLE_MASK_MAX_BYTE;

	const HASHTABLE_MASK_MAX_ITEM = HASHTABLE_MASK_MAX_ITEM;

	const HASHTABLE_KEY_MAX = HASHTABLE_KEY_MAX;

	const HASHTABLE_VALUE_MAX = HASHTABLE_VALUE_MAX;

	const MEMLINK_VALUE_ALL = MEMLINK_VALUE_ALL;

	const MEMLINK_VALUE_VISIBLE = MEMLINK_VALUE_VISIBLE;

	const MEMLINK_VALUE_TAGDEL = MEMLINK_VALUE_TAGDEL;

	const MEMLINK_VALUE_REMOVED = MEMLINK_VALUE_REMOVED;

	const MEMLINK_LIST = MEMLINK_LIST;

	const MEMLINK_QUEUE = MEMLINK_QUEUE;

	const MEMLINK_SORTLIST = MEMLINK_SORTLIST;

	const MEMLINK_SORTLIST_LOOKUP_STEP = MEMLINK_SORTLIST_LOOKUP_STEP;

	const MEMLINK_VALUE_INT = MEMLINK_VALUE_INT;

	const MEMLINK_VALUE_INT4 = MEMLINK_VALUE_INT4;

	const MEMLINK_VALUE_UINT = MEMLINK_VALUE_UINT;

	const MEMLINK_VALUE_UINT4 = MEMLINK_VALUE_UINT4;

	const MEMLINK_VALUE_LONG = MEMLINK_VALUE_LONG;

	const MEMLINK_VALUE_INT8 = MEMLINK_VALUE_INT8;

	const MEMLINK_VALUE_ULONG = MEMLINK_VALUE_ULONG;

	const MEMLINK_VALUE_UINT8 = MEMLINK_VALUE_UINT8;

	const MEMLINK_VALUE_FLOAT = MEMLINK_VALUE_FLOAT;

	const MEMLINK_VALUE_FLOAT4 = MEMLINK_VALUE_FLOAT4;

	const MEMLINK_VALUE_DOUBLE = MEMLINK_VALUE_DOUBLE;

	const MEMLINK_VALUE_FLOAT8 = MEMLINK_VALUE_FLOAT8;

	const MEMLINK_VALUE_STRING = MEMLINK_VALUE_STRING;

	const MEMLINK_VALUE_OBJ = MEMLINK_VALUE_OBJ;

	const MEMLINK_SORTLIST_ORDER_ASC = MEMLINK_SORTLIST_ORDER_ASC;

	const MEMLINK_SORTLIST_ORDER_DESC = MEMLINK_SORTLIST_ORDER_DESC;

	const SYNC_BUF_SIZE = SYNC_BUF_SIZE;

	const MEMLINK_WRITE_LOG = MEMLINK_WRITE_LOG;

	const MEMLINK_NO_LOG = MEMLINK_NO_LOG;

	const MEMLINK_FIND_NEXT = MEMLINK_FIND_NEXT;

	const MEMLINK_FIND_PREV = MEMLINK_FIND_PREV;

	const MEMLINK_CMP_RANGE = MEMLINK_CMP_RANGE;

	const MEMLINK_CMP_EQUAL = MEMLINK_CMP_EQUAL;

	const MEMLINK_READER = MEMLINK_READER;

	const MEMLINK_WRITER = MEMLINK_WRITER;

	const MEMLINK_ALL = MEMLINK_ALL;

	const MAX_PACKAGE_LEN = MAX_PACKAGE_LEN;

	static function memlink_result_parse($retdata,$result) {
		return memlink_result_parse($retdata,$result);
	}

	static function memlink_result_free($result) {
		memlink_result_free($result);
	}

	static function memlink_create($host,$readport,$writeport,$timeout) {
		$r=memlink_create($host,$readport,$writeport,$timeout);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new MemLink($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function memlink_destroy($m) {
		memlink_destroy($m);
	}

	static function memlink_close($m) {
		memlink_close($m);
	}

	static function memlink_cmd_ping($m) {
		return memlink_cmd_ping($m);
	}

	static function memlink_cmd_dump($m) {
		return memlink_cmd_dump($m);
	}

	static function memlink_cmd_clean($m,$key) {
		return memlink_cmd_clean($m,$key);
	}

	static function memlink_cmd_stat($m,$key,$stat) {
		return memlink_cmd_stat($m,$key,$stat);
	}

	static function memlink_cmd_stat_sys($m,$stat) {
		return memlink_cmd_stat_sys($m,$stat);
	}

	static function memlink_cmd_create($m,$key,$valuelen,$maskstr,$listtype,$valuetype) {
		return memlink_cmd_create($m,$key,$valuelen,$maskstr,$listtype,$valuetype);
	}

	static function memlink_cmd_create_list($m,$key,$valuelen,$maskstr) {
		return memlink_cmd_create_list($m,$key,$valuelen,$maskstr);
	}

	static function memlink_cmd_create_queue($m,$key,$valuelen,$maskstr) {
		return memlink_cmd_create_queue($m,$key,$valuelen,$maskstr);
	}

	static function memlink_cmd_create_sortlist($m,$key,$valuelen,$maskstr,$valuetype) {
		return memlink_cmd_create_sortlist($m,$key,$valuelen,$maskstr,$valuetype);
	}

	static function memlink_cmd_del($m,$key,$value,$valuelen) {
		return memlink_cmd_del($m,$key,$value,$valuelen);
	}

	static function memlink_cmd_insert($m,$key,$value,$valuelen,$maskstr,$pos) {
		return memlink_cmd_insert($m,$key,$value,$valuelen,$maskstr,$pos);
	}

	static function memlink_cmd_lpush($m,$key,$value,$valuelen,$maskstr) {
		return memlink_cmd_lpush($m,$key,$value,$valuelen,$maskstr);
	}

	static function memlink_cmd_rpush($m,$key,$value,$valuelen,$maskstr) {
		return memlink_cmd_rpush($m,$key,$value,$valuelen,$maskstr);
	}

	static function memlink_cmd_lpop($m,$key,$num,$result) {
		return memlink_cmd_lpop($m,$key,$num,$result);
	}

	static function memlink_cmd_rpop($m,$key,$num,$result) {
		return memlink_cmd_rpop($m,$key,$num,$result);
	}

	static function memlink_cmd_move($m,$key,$value,$valuelen,$pos) {
		return memlink_cmd_move($m,$key,$value,$valuelen,$pos);
	}

	static function memlink_cmd_mask($m,$key,$value,$valuelen,$maskstr) {
		return memlink_cmd_mask($m,$key,$value,$valuelen,$maskstr);
	}

	static function memlink_cmd_tag($m,$key,$value,$valuelen,$tag) {
		return memlink_cmd_tag($m,$key,$value,$valuelen,$tag);
	}

	static function memlink_cmd_range($m,$key,$kind,$maskstr,$frompos,$len,$result) {
		return memlink_cmd_range($m,$key,$kind,$maskstr,$frompos,$len,$result);
	}

	static function memlink_cmd_rmkey($m,$key) {
		return memlink_cmd_rmkey($m,$key);
	}

	static function memlink_cmd_count($m,$key,$maskstr,$count) {
		return memlink_cmd_count($m,$key,$maskstr,$count);
	}

	static function memlink_cmd_del_by_mask($m,$key,$maskstr) {
		return memlink_cmd_del_by_mask($m,$key,$maskstr);
	}

	static function memlink_cmd_sortlist_insert($m,$key,$value,$valuelen,$maskstr) {
		return memlink_cmd_sortlist_insert($m,$key,$value,$valuelen,$maskstr);
	}

	static function memlink_cmd_sortlist_range($m,$key,$kind,$maskstr,$valmin,$vminlen,$valmax,$vmaxlen,$result) {
		return memlink_cmd_sortlist_range($m,$key,$kind,$maskstr,$valmin,$vminlen,$valmax,$vmaxlen,$result);
	}

	static function memlink_cmd_sortlist_del($m,$key,$valmin,$vminlen,$valmax,$vmaxlen) {
		return memlink_cmd_sortlist_del($m,$key,$valmin,$vminlen,$valmax,$vmaxlen);
	}

	static function memlink_cmd_sortlist_count($m,$key,$maskstr,$valmin,$vminlen,$valmax,$vmaxlen,$count) {
		return memlink_cmd_sortlist_count($m,$key,$maskstr,$valmin,$vminlen,$valmax,$vmaxlen,$count);
	}

	static function memlink_cmd_insert_mkv($m,$mkv) {
		return memlink_cmd_insert_mkv($m,$mkv);
	}

	static function memlink_mkv_destroy($mkv) {
		return memlink_mkv_destroy($mkv);
	}

	static function memlink_mkv_add_key($mkv,$keyobj) {
		return memlink_mkv_add_key($mkv,$keyobj);
	}

	static function memlink_ikey_add_value($keyobj,$valobj) {
		return memlink_ikey_add_value($keyobj,$valobj);
	}

	static function memlink_imkv_create() {
		$r=memlink_imkv_create();
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new MemLinkInsertMkv($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function memlink_ikey_create($key,$keylen) {
		$r=memlink_ikey_create($key,$keylen);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new MemLinkInsertKey($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function memlink_ival_create($value,$valuelen,$maskstr,$pos) {
		$r=memlink_ival_create($value,$valuelen,$maskstr,$pos);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new MemLinkInsertVal($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function memlink_cmd_read_conn_info($m,$rcinfo) {
		return memlink_cmd_read_conn_info($m,$rcinfo);
	}

	static function memlink_cmd_write_conn_info($m,$wcinfo) {
		return memlink_cmd_write_conn_info($m,$wcinfo);
	}

	static function memlink_cmd_sync_conn_info($m,$scinfo) {
		return memlink_cmd_sync_conn_info($m,$scinfo);
	}

	static function memlink_rcinfo_free($info) {
		return memlink_rcinfo_free($info);
	}

	static function memlink_wcinfo_free($info) {
		return memlink_wcinfo_free($info);
	}

	static function memlink_scinfo_free($info) {
		return memlink_scinfo_free($info);
	}
}*/

/* PHP Proxy Classes */
class MemLinkInsertVal {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkInsertVal_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkInsertVal_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkInsertVal_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_insert_mvalue_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkInsertVal();
	}
}

class MemLinkInsertKey {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkInsertKey_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkInsertKey_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkInsertKey_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_insert_mkey_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkInsertKey();
	}
}

class MemLinkInsertMkv {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkInsertMkv_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkInsertMkv_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkInsertMkv_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_insert_mkv') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkInsertMkv();
	}
    
    function __destruct() {
        memlink_mkv_destroy($this->cPtr);
    }
}

class MemLinkStat {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkStat_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkStat_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkStat_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_stat') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkStat();
	}
}

class MemLinkStatSys {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkStatSys_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkStatSys_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkStatSys_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__ht_stat_sys') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkStatSys();
	}
}

class MemLink {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLink_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLink_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLink_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_client') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLink();
	}
}

class MemLinkCount {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'visible_count') return MemLinkCount_visible_count_set($this->_cPtr,$value);
		if ($var === 'tagdel_count') return MemLinkCount_tagdel_count_set($this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkCount_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkCount_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_count') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkCount();
	}
}

class MemLink_Item {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkItem_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkItem_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkItem_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkItem();
	}
}

class MemLinkResult {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkResult_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkResult_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkResult_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_result') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkResult();
	}
    function __destruct() {
        memlink_result_free($this->cPtr);
    }
}

class MemLink_Rconn_Item {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkRcItem_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkRcItem_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkRcItem_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_rconn_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkRcItem();
	}
}

class MemLink_Wconn_Item {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkWcItem_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkWcItem_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkWcItem_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_wconn_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkWcItem();
	}
}

class MemLinkScItem {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'MemLinkScItem_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkScItem_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkScItem_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_sconn_item') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkScItem();
	}
}

class MemLinkRcInfo {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'root') return MemLinkRcInfo_root_set($this->_cPtr,$value);
		if ($var === 'conncount') return MemLinkRcInfo_conncount_set($this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkRcInfo_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkRcInfo_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_rconn_info') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkRcInfo();
	}
    function __destruct() {
        memlink_rcinfo_free($this->_cPtr);
    }
}

class MemLinkWcInfo {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'root') return MemLinkWcInfo_root_set($this->_cPtr,$value);
		if ($var === 'conncount') return MemLinkWcInfo_conncount_set($this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkWcInfo_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkWcInfo_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_wconn_info') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkWcInfo();
	}

    function __destruct() {
        memlink_wcinfo_free($this->cPtr);
    }
}

class MemLinkScInfo {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'root') return MemLinkScInfo_root_set($this->_cPtr,$value);
		if ($var === 'conncount') return MemLinkScInfo_conncount_set($this->_cPtr,$value);
		if ($var === 'thisown') return swig_memlink_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('MemLinkScInfo_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'MemLinkScInfo_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_memlink_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p__memlink_Sconn_info') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_MemLinkScInfo();
	}

    function __destruct() {
        memlink_scinfo_free($this->cPtr);
    }
}


?>
