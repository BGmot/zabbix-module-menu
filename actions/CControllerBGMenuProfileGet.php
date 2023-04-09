<?php declare(strict_types = 1);

namespace Modules\BGMenu\Actions;


use CControllerProfileUpdate;
use CControllerResponseData;
use CProfile;

class CControllerBGMenuProfileGet extends CControllerProfileUpdate {

	protected function init(): void {
		$this->disableCsrfValidation();
	}

	protected function checkInput() {
		return true;
	}

	protected function doAction() {
		$menu_items_array = CProfile::findByIdxPattern('%web.bgmenu%', 0);
		$this->setResponse(new CControllerResponseData(['main_block' => json_encode($menu_items_array)]));
	}
}
