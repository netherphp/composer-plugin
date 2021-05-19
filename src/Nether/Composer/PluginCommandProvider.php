<?php

namespace Nether\Composer;

use Composer;
use Nether;

class PluginCommandProvider
implements Composer\Plugin\Capability\CommandProvider {

	public function
	GetCommands():
	array {

		return [
			new Nether\Composer\Command\SetUpdateWarning
		];
	}

}
