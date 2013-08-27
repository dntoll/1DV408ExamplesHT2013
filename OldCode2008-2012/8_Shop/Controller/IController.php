<?php


namespace Shop\Controller;


/**
 * Interface för våra "aktiva kontrollers"
 * Detta interface uppfylls av ProductController och ProductListController
 * 
 * och interfacet används i ShopMasterController::HandleActiveController() 
 * för att få ett polymorfistiskt anrop.
 * 
 * PHP kräver inte interface som C# för polymorfism men jag använder dem ändå för att:
 *  1. Använda samma sätt att koda som i C# och C++
 *  2. Jag får felmeddelanden om jag glömt något.
 */
interface IController {
	public function DoControll(\Shop\View\NavigationView $navigationView);
}