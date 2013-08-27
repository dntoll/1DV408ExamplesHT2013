<?php

namespace View;

class PageCompositionView {
	
	/**
	 * @return String HTML
	 */
	public function merge($productHtml, $likeHtml) {
		return "<div>$productHtml <hr/> $likeHtml </div>";
	}
}
