<?php

namespace Modules\BGMenu;

use CController as CAction;
use APP;

class Module extends \Zabbix\Core\CModule {

	public function onTerminate(CAction $action): void {
		$action_page = $action->getAction();
		$router = clone APP::Component()->get('router');
		$layout = $router->getLayout();
		if ($action_page) {
			if ($action_page != 'jsrpc.php' &&
			    $layout != 'layout.widget' &&
			    $layout != 'layout.json') {
				echo '<script type="text/javascript">';
				echo file_get_contents(__DIR__.'/js/bg_menu.js');
				echo '</script>';
			}
		}
	}
}
