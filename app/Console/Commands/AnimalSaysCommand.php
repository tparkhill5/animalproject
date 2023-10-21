<?php

namespace App\Console\Commands;

use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\DuplicateAnimalNameException;
use App\Services\AnimalMsgService;
use App\Services\AnimalService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class AnimalSaysCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animal:says
                            {name : The name of your animal}
                            {type : The type/species of your animal}
                            {--save : Save your animal!}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns a string indicating the supplied name for the animal, and the sound it makes';

    /**
     * @codeCoverageIgnore
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => ['What is the name of your animal?', 'E.g. Mr. Sprinkles'],
            'type' => ['What is the type or species of your animal?', 'E.g. Cat'],
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle(
        AnimalService $service,
        AnimalMsgService $msg,
    ) {
        $type = strtolower($this->argument('type'));

        try {
            $animal = $service->find($type);
            $name = $this->argument('name');

            if ($service->isImaginary($animal)) {
                $this->line($msg->notReal($animal));
            } else {
                $this->line($msg->says($name, $animal));
            }

            if ($this->option('save')) {
                $this->info("Saving {$name} the {$animal} to the database..");
                try {
                    $service->persist($name, $animal);
                    $this->info('Saved!');
                } catch (DuplicateAnimalNameException $e) {
                    $this->warn("Oops, looks like we already have a {$e->getType()} named {$e->getName()}!");
                // @codeCoverageIgnoreStart
                } catch (\Exception $e) {
                    $this->error('Something went wrong!');
                    $this->error($e->getMessage());
                }
                // @codeCoverageIgnoreEnd
            }
        } catch (AnimalNotFoundException $e) {
            $this->info($msg->unknown($type));
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
            $this->error($e->getMessage());
        }
        // @codeCoverageIgnoreEnd
    }
}
