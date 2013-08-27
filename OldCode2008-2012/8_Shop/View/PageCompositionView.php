<?php

namespace Shop\View;

class PageCompositionView {
	
	/**
	 * Bygg en HTML sida utifrån utdata ur controllers
	 */
	public function BuildPage(\Common\Page $a_menu, 
							  \Common\Page $a_controller, 
							  $addHTMLString,  //bara html
							  \Common\Page $a_shoppingCart) {
		$ret = new \Common\Page();
		
		//bygg sidans titel
		$ret->m_title = $a_controller->m_title . " | " . $a_menu->m_title;
		
		$ret->m_body = "
		
		<div>
			<div id='addStyle'>
				$addHTMLString
			</div>
			
			<div id='menuStyle'>
				$a_menu->m_body
			</div>
			<div id='controllerOutput'>
				$a_controller->m_body
			</div>
			<div id='cart'>
				$a_shoppingCart->m_body
			</div>
			
		</div>
		";
		
		
		return $ret;
	}
}
