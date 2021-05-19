<?php

namespace Nether\Composer;
use Composer;
use Nether;

use Exception;

class Plugin
implements
	Composer\Plugin\PluginInterface,
	Composer\EventDispatcher\EventSubscriberInterface,
	Composer\Plugin\Capable {

	////////////////////////////////////////////////////////////////
	// implements Composer\Plugin\PluginInterface //////////////////

	public function
	Activate(Composer\Composer $Inst, Composer\IO\IOInterface $IO) {
	/*//
	@date 2021-05-19
	//*/

		return;
	}

	public function
	Deactivate(Composer\Composer $Inst, Composer\IO\IOInterface $IO) {
	/*//
	@date 2021-05-19
	//*/

		return;
	}

	public function
	Uninstall(Composer\Composer $Inst, Composer\IO\IOInterface $IO) {
	/*//
	@date 2021-05-19
	//*/

		return;
	}

	////////////////////////////////////////////////////////////////
	// Composer\EventDispatcher\EventSubscriberInterface ///////////

	static public function
	GetSubscribedEvents():
	array {
	/*//
	@date 2021-05-19
	//*/

		return [
			'pre-update-cmd' => 'OnComposerUpdate'
		];
	}

	////////////////////////////////////////////////////////////////
	// Composer\Plugin\Capable /////////////////////////////////////

	public function
	getCapabilities():
	array {

		return [
			'Composer\\Plugin\\Capability\\CommandProvider'
			=> 'Nether\\Composer\\PluginCommandProvider'
		];
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	OnComposerUpdate():
	void {

		$File = Nether\Composer\Command\SetUpdateWarning::GetFilename();
		$Message = NULL;

		// no cop no stop

		if(!file_exists($File))
		return;

		// check that it has something

		$Message = trim(file_get_contents($File));

		if(!$Message)
		return;

		// reed alert

		throw new Exception($Message);
		return;
	}

}
