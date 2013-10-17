<?php
$this->multis =$this->patchworksView->getMultis();
$this->multidatabase_id = '';
$this->multidatabase_name = ' 未選択 ';

if ( $this->config  && isset( $this->config['multidatabase_id'])) {
	$this->multidatabase_id = $this->config['multidatabase_id'];
	$this->multidatabase_name = $this->multis[$this->config['multidatabase_id']]['multidatabase_name'];
	$this->multidata = $this->patchworksView->getMultiTitle($this->config['multidatabase_id']);
}
