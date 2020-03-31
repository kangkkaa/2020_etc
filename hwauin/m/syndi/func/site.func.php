<?
/**
 * 사이트 정보
 **/
function Syndi_getSiteInfo($args)
{
	$title = "솔루션홈페이지";
	$tag = SyndicationHandler::getTag("site");

	$oSite = new SyndicationSite;
	$oSite->setId($tag);
	$oSite->setTitle($title);
	$oSite->setUpdated(date("YmdHis"));

	// 홈페이지 주소
	$link_alternative = sprintf("http://%s", $GLOBALS['syndi_tag_domain']);
	$oSite->setLinkAlternative($link_alternative);

	$link_self = sprintf("%s?id=%s&type=%s", $GLOBALS['syndi_echo_url'], $tag, $args->type);
	$oSite->setLinkSelf($link_self);

	return $oSite;
}

/**
 * Channel(게시판) 목록 
 **/
function Syndi_getChannelList($args)
{
	$oDB = &SyndiDB::getInstance();
	$oDB->connect();

	$where = "";

	if($args->target_channel_id) $where .= " AND board_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND reg_date >= '". $args->start_time."'";
	if($args->end_time) $where .= " AND reg_date <= '". $args->end_time."'";

	$sql = "SELECT board_id, board_name, board_memo FROM boardAdmin WHERE 1=1". $where;
	$sql .= " ORDER BY reg_date DESC ";
	$sql .= sprintf(" LIMIT %s,%s", ($args->page-1)*$args->max_entry, $args->max_entry);

	$result = $oDB->query($sql);

	$channel_list = array();
	while($row = $oDB->fetch_assoc($result))
	{
		$tag = SyndicationHandler::getTag("channel", $row['board_id']);
		$oChannel = new SyndicationChannel;
		$oChannel->setId($tag);
		$oChannel->setTitle($row['board_name']);
		$oChannel->setType('web');
		$oChannel->setSummary($row['board_memo']);
		$oChannel->setUpdated(date("YmdHis"));

		$link_self = sprintf("%s?id=%s&type=%s", $GLOBALS['syndi_echo_url'], $tag, $args->type);
		$oChannel->setLinkSelf($link_self);

		// 게시판 웹주소
		$link_alternative = urlencode("http://gsi123.mireene.com/sub.php?ck=B&id=".$row['board_id']);
		$oChannel->setLinkAlternative($link_alternative);

		$channel_list[] = $oChannel;
	}

	$oDB->free($result);

	return $channel_list;
}


/**
 * 삭제 게시물 목록 
 * 삭제된 게시물에 대해 로그가 필요
 **/
function Syndi_getDeletedList($args)
{
	$oDB = &SyndiDB::getInstance();
	$oDB->connect();

	$where = "";

	if($args->target_content_id) $where .= " AND content_id=". $args->target_content_id;
	if($args->target_channel_id) $where .= " AND bbs_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND delete_date >= ". $args->start_time;
	if($args->end_time) $where .= " AND delete_date <= ". $args->end_time;

	$sql = "SELECT content_id, bbs_id, title, delete_date, link_alternative FROM syndi_delete_content_log WHERE 1=1" . $where;
	$sql .= " ORDER BY delete_date DESC ";
	$sql .= sprintf(" LIMIT %s,%s", ($args->page-1)*$args->max_entry, $args->max_entry);
	$result = mysql_query($sql);
	$result = $oDB->query($sql);
	$article_list = array();
	while($row = $oDB->fetch_assoc($result))
	{
		$oDeleted = new SyndicationDeleted;
		$tag = SyndicationHandler::getTag("article", $row['bbs_id'], $row['content_id']);
		$oDeleted->setId($tag);
		$oDeleted->setTitle($row['title']);
		$oDeleted->setUpdated(SyndicationHandler::getDate($row['delete_date']));
		$oDeleted->setDeleted(SyndicationHandler::getDate($row['delete_date']));
		$oDeleted->setLinkAlternative($row['link_alternative']);

		$deleted_list[] = $oDeleted;
	}

	$oDB->free($result);

	return $deleted_list;
}

/**
 * 게시물 목록 
 **/
function Syndi_getArticleList($args)
{
	/*
	$args->target_content_id	//게시물 번호
	$args->target_channel_id	//게시판 ID
	$args->start_time			//기간 설정
	$args->end_time
	$args->max_entry			//출력 목록당 개수
	$args->page					//페이지 번호
	*/

	$oDB = &SyndiDB::getInstance();
	$oDB->connect();

	$where = "";

	if($args->target_content_id) $where .= " AND b_id=". $args->target_content_id;
	if($args->target_channel_id) $where .= " AND board_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND syndi_time >= '". $args->start_time."'";
	if($args->end_time) $where .= " AND syndi_time <= '". $args->end_time."'";

	$sql = "SELECT * FROM boardTable WHERE 1=1" . $where;
	$sql .= " ORDER BY b_writeday DESC ";
	$sql .= sprintf(" LIMIT %s,%s", ($args->page-1)*$args->max_entry, $args->max_entry);

	$result = $oDB->query($sql);
	$article_list = array();
	while($row = $oDB->fetch_assoc($result))
	{
		$oArticle = new SyndicationArticle;
		$tag = SyndicationHandler::getTag("article", $row['board_id'], $row['b_id']);
		$oArticle->setId($tag);
		$oArticle->setTitle($row['b_subject']);
		$oArticle->setContent($row['b_contents']);
		$oArticle->setType('web');
		$oArticle->setCategory($row['b_category']);
		$oArticle->setName($row['b_writerName']);
//		$oArticle->setUpdated(SyndicationHandler::getDate($row['b_writeday']));
		$oArticle->setPublished(SyndicationHandler::getDate($row['b_writeday']));
		// 게시물 웹주소
		$link_alternative = "http://gsi123.mireene.com/sub.php?ck=B&id=".$row['board_id']."&b_idx=".$row['b_id']."&mode=view";
		// 게시판 웹주소
		$link_channel_alternative = "http://gsi123.mireene.com/sub.php?ck=B&id=".$row['board_id'];
		$oArticle->setLinkChannel($tag);
		$oArticle->setLinkAlternative($link_alternative);
		$oArticle->setLinkChannelAlternative($link_channel_alternative);

		$article_list[] = $oArticle;
	}

	$oDB->free($result);

	return $article_list;
}

/**
 * 게시물 목록 출력시 다음 페이지 번호 
 **/
function Syndi_getArticleNextPage($args)
{
	$oDB = &SyndiDB::getInstance();
	$oDB->connect();

	$where = "";

	if($args->target_content_id) $where .= " AND b_id=". $args->target_content_id;
	if($args->target_channel_id) $where .= " AND board_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND syndi_time >= ". $args->start_time;
	if($args->end_time) $where .= " AND syndi_time <= ". $args->end_time;

	$count_sql = "SELECT COUNT(*) AS cnt FROM boardTable WHERE 1=1" . $where;
	$result = $oDB->query($count_sql);
	$row = $oDB->fetch_assoc($result);
	$oDB->free($result);
	$oDB->close();

	$total_count = $row['cnt'];
	$total_page = ceil($total_count / $args->max_entry);

	if($args->page < $total_page)
	{
		return array('page'=>$args->page+1);
	}
	else
	{
		return array('page'=>1); 
	}
}

/**
 * 게시물 삭제 목록 출력시 다음 페이지 번호 
 **/
function Syndi_getDeletedNextPage($args)
{
	$oDB = &SyndiDB::getInstance();
	$oDB->connect();

	$where = "";

	if($args->target_content_id) $where .= " AND content_id=". $args->target_content_id;
	if($args->target_channel_id) $where .= " AND bbs_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND delete_date >= ". $args->start_time;
	if($args->end_time) $where .= " AND delete_date <= ". $args->end_time;

	$count_sql = "SELECT COUNT(*) AS cnt FROM syndi_delete_content_log WHERE 1=1" . $where;
	$result = $oDB->query($count_sql);
	$row = $oDB->fetch_assoc($result);
	$oDB->free($result);
	$oDB->close();

	$total_count = $row['cnt'];
	$total_page = ceil($total_count / $args->max_entry);

	if($args->page < $total_page)
	{
		return array('page'=>$args->page+1);
	}
	else
	{
		return array('page'=>1); 
	}
}

/**
 * Channel 게시판 목록 출력시 다음 페이지 번호 
 **/
function Syndi_getChannelNextPage($args)
{
	$oDB = new SyndiDB;
	$oDB->connect();

	$where = "";

	if($args->target_channel_id) $where .= " AND board_id='". $args->target_channel_id ."'";
	if($args->start_time) $where .= " AND reg_date >= ". $args->start_time;
	if($args->end_time) $where .= " AND reg_date <= ". $args->end_time;

	$count_sql = "SELECT COUNT(*) AS cnt FROM boardAdmin WHERE 1=1" . $where;
	$result = $oDB->query($count_sql);
	$row = $oDB->fetch_assoc($result);
	$oDB->free($result);
	$oDB->close();

	$total_count = $row['cnt'];
	$total_page = ceil($total_count / $args->max_entry);

	if($args->page < $total_page)
	{
		return array('page'=>$args->page+1);
	}
	else
	{
		return array('page'=>1); 
	}
}

$oSyndicationHandler = &SyndicationHandler::getInstance();
$oSyndicationHandler->registerFunction("site_info", "Syndi_getSiteInfo");
$oSyndicationHandler->registerFunction("channel_list", "Syndi_getChannelList");
$oSyndicationHandler->registerFunction("channel_next_page", "Syndi_getChannelNextPage");
$oSyndicationHandler->registerFunction("article_list", "Syndi_getArticleList");
$oSyndicationHandler->registerFunction("article_next_page", "Syndi_getArticleNextPage");
$oSyndicationHandler->registerFunction("deleted_list", "Syndi_getDeletedList");
$oSyndicationHandler->registerFunction("deleted_next_page", "Syndi_getDeletedNextPage");

class SyndiDB
{
	var $conn = null;

	function getInstance()
	{
		if(!$GLOBALS['__SyndiDB__'])
		{
			$GLOBALS['__SyndiDB__'] = new SyndiDB;
		}
		
		return $GLOBALS['__SyndiDB__'];
	}

	function connect()
	{
		if($this->conn) return true;

		$host = $GLOBALS['mysql_info']['host'];
		$user = $GLOBALS['mysql_info']['user'];
		$password = $GLOBALS['mysql_info']['password'];
		$database = $GLOBALS['mysql_info']['database'];
		
		$conn = mysql_connect($host,$user,$password);
		if(!$conn) return false;

		mysql_select_db($database);

		if(strtolower($GLOBALS['syndi_from_encoding']) == "utf-8")
		{
			mysql_unbuffered_query("set names utf8", $conn);
		}

		$this->conn = $conn;

		register_shutdown_function(array(&$this, "close"));
	}

	function close()
	{
		if($this->conn)
		{
			@mysql_close($this->conn);
		}
	}

	function query($query)
	{
		return mysql_query($query, $this->conn);
	}

	function fetch_assoc($result)
	{
		return mysql_fetch_assoc($result);
	}

	function escape($str)
	{
		if($this->conn) return mysql_real_escape_string($str);
		return mysql_escape_string($str);
	}

	function free($result)
	{
		mysql_free_result($result);
	}
}
?>