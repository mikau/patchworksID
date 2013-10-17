<?php
// user agent の取得
$this->ip = $_SERVER['REMOTE_ADDR'];
$this->login_id = $this->session->getParameter('_login_id');
$this->multis =$this->patchworksView->getMultis();

$this->xxx = "multidatabase_id を指定してください";

// 汎用データベースのID が付与されているのが前提
if ( $this->config  && isset( $this->config['multidatabase_id'])) {
	$this->multidatabase_id = $this->config['multidatabase_id'];
	// メタデータのID逆引きをとってくる
	$metadata = $this->patchworksView->getMultiMetaName($this->multidatabase_id);
	
	$multidatabaseContent = $this->patchworksView->getMultidatabaseContent( $this->multidatabase_id, 'insert_time DESC');
	$contentIds = array();
	$contentInserttimeArray = array();
	foreach($multidatabaseContent as $_multidatabaseContent){
		$contentIds[] = $_multidatabaseContent['content_id'];
		$contentInserttimeArray[$_multidatabaseContent['content_id']] = $_multidatabaseContent['insert_time'];
	}

	$viewData = array();
	foreach($contentIds as $contentId){
		// 項目と値の組み合わせでデータを取得する。連想配列でもどってくるのに注意
		$contents[$contentId] = $this->patchworksView->getMultiByContentID( $contentId );
		$contents[$contentId]['insert_time'] = $contentInserttimeArray[$contentId];
	//	$contents[] = array_push($this->patchworksView->getMultiByContentID( $contentId ), $contentInserttimeArray[$contentId]);
	}
	$this->view = $contents;
	$this->inserttime = $contentInserttimeArray;
}
