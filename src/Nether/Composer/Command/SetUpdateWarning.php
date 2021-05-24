<?php

namespace Nether\Composer\Command;
use Composer;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetUpdateWarning
extends Composer\Command\BaseCommand {

	static protected // string - this will force 7.4+ lol
	$Filename = 'composer-update-warning.txt';

	static public function
	GetFilename():
	string {
	/*//
	@date 2021-05-19
	//*/

		$File = sprintf(
			'%s%s%s',
			getcwd(),
			DIRECTORY_SEPARATOR,
			static::$Filename
		);

		return $File;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	Configure():
	void {
	/*//
	@date 2021-05-19
	//*/

		$this
		->SetName('set-update-warning')
		->AddArgument(
			'message', NULL,
			'The message that should be shown when attempting to update.'
		);

		return;
	}

	protected function
	Execute(InputInterface $Input, OutputInterface $Output):
	void {
	/*//
	@date 2021-05-19
	//*/

		$Message = trim($Input->GetArgument('message'));

		if($Message)
		$this->Execute_WriteUpdateWarning($Input,$Output,$Message);
		else
		$this->Execute_ClearUpdateWarning($Input,$Output);

		return;
	}

	protected function
	Execute_WriteUpdateWarning(InputInterface $Input, OutputInterface $Output, string $Message):
	void {
	/*//
	@date 2021-05-19
	//*/

		$File = $this::GetFilename();
		$Dir = dirname($File);
		$Result = 0;

		////////

		if(file_exists($File)) {
			if(!is_writable($File))
			throw new Exception("File exists but is not writable: {$File}");
		}

		else {
			if(!is_writable($Dir))
			throw new Exception("Unable to write {$this::$Filename} to directory: {$Dir}");
		}

		////////

		$Result = file_put_contents($File,$Message);
		$Output->Writeln("Wrote {$Result} bytes to {$this::$Filename}");
		return;
	}

	protected function
	Execute_ClearUpdateWarning(InputInterface $Input, OutputInterface $Output):
	void {
	/*//
	@date 2021-05-19
	//*/

		$File = $this::GetFilename();
		$Dir = dirname($File);

		if(!file_exists($File))
		return;

		if(!is_writable($Dir))
		throw new Exception("Unable to delete {$File} for you.");

		unlink($File);
		return;
	}

}
