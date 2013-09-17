<?php

namespace view;

class Navigation {
	public function reloadToFrontpage() {
		header("Location: index.php");
	}
}