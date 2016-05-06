<?php
	function filter($content) {
		$content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);
		$content = preg_replace('script', "", $content);
		return $content;
	}
?>
