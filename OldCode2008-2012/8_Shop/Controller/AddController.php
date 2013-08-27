<?php
    namespace Shop\Controller;
	
	/**
	 * Fejk-controller för annonser
	 * är inte någon kontroller utan en vy eftersom vi inte hanterar någon indata
	 * 
	 * En annonskontroller som hanterar indata skulle kunna registrera klick
	 */
	class AddController {
		public function DoControll() {
			return "<div><a href='http://www.spam.com'><img src='http://www.spam.com/~/media/Images/Homepage%20Can%20Images/29_can-hickorysmoke.ashx' alt='Köp du vet att du vill!'></a></div>";
		}
	}
