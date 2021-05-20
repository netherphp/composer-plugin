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

		$this->Composer = $Inst;
		$this->IO = $IO;
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
	GetCapabilities():
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

		// that event actually gets fired for more than update commands and
		// im still having a hard time getting access to all the things
		// composer makes protected or private and has exactly what i need
		// to know. like the damn IO->input, with no helper methods that are
		// actually helpful upon it.

		if(!in_array('update',$_SERVER['argv']))
		return;

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
