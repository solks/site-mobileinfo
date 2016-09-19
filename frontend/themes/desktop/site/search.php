<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Поиск по сайту';
echo '<h1 class="page-title">'.$this->title.'</h1>';
?>
<div id="cse-search-results"></div>
<script type="text/javascript">
	var googleSearchIframeName = "cse-search-results";
	var googleSearchFormName = "cse-search-box";
	var googleSearchFrameWidth = 800;
	var googleSearchDomain = "www.google.ru";
	var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>

