<?php declare(strict_types = 1);

namespace Modules\BGMenu\Actions;


use CControllerProfileUpdate;
use CControllerResponseData;
use CProfile;

class CControllerBGMenuProfileUpdate extends CControllerProfileUpdate {

	protected function checkInput() {
		$fields = [
			'idx' =>		'required|string',
			'value_int' =>		'required|int32',
			'idx2' =>		'array_id'
		];

		$ret = $this->validateInput($fields);

		if ($ret) {
			switch ($this->getInput('idx')) {
				case !!preg_match('/web\.bgmenu\.\S+/', $this->getInput('idx')):
					$ret = true;
					break;

				default:
					$ret = false;
			}
		}

		if (!$ret) {
			$this->setResponse(new CControllerResponseData(['main_block' => '']));
		}

		return $ret;
	}

	protected function doAction() {
		$idx = $this->getInput('idx');
		$value_int = $this->getInput('value_int');

		DBstart();
		if ($value_int == 1) { // default value
			CProfile::delete($idx, $this->getInput('idx2'));
		}
		else {
			foreach ($this->getInput('idx2') as $idx2) {
				CProfile::update($idx, $value_int, PROFILE_TYPE_INT, $idx2);
			}
		}
		DBend();

		$this->setResponse(new CControllerResponseData(['main_block' => '']));
	}
}
