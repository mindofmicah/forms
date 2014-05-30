<?php
namespace MindOfMicah\Forms\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

use MindOfMicah\Forms\RuleFormatter;

class FormValidatorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'form:validator';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new form validator.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $file, RuleFormatter $formatter)
    {
        $this->file = $file;
        $this->formatter = $formatter;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $properties = explode(',',$this->ask('Which properties will you create rules for? Comma separated'));
        $rules = [];
        foreach ($properties as $property) {
            $property = trim($property);
            $rules[$property] = [];
            $this->info('start listing the rules for "' . $property.'"');
            while ($rule = $this->ask('')) {
                $rules[$property][] = $rule;
            }
        }

        $this->file->put(
            app_path() . '/Whamdonk/Forms/' . $this->argument('name') . '.php',
            str_replace(
                ['{{$NAME$}}', '{{$RULES$}}'],
                [$this->argument('name'), $this->formatter->format($rules)],
                $this->file->get('vendor/mindofmicah/forms/src/MindOfMicah/Forms/templates/stub.txt')
            )
        );
		$this->info($this->argument('name') . ' was added as a validator');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'Name of the new validator.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
