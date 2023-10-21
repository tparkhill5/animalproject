<?php

namespace App\Console\Commands;

use App\Services\AnimalService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Str;

class AnimalFindCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animal:find
                            {name : The name of your animal}
                            {type? : The type of your animal}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns a saved animal record';

    /**
     * @codeCoverageIgnore
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => ['What is the name of your animal?', 'E.g. Mr. Sprinkles'],
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle(
        AnimalService $service,
    ) {
        $name = $this->argument('name');
        $type = strtolower($this->argument('type'));

        try {
            $match = $service->findByName($name, $type);

            if ($match->count() === 0) {
                $this->line("No results for {$name}");
            } else {
                if ($match->count() > 1) {
                    $type = $this->choice(
                        "Multiple entries found for the name {$name}, please select the type",
                        $match->pluck('typeName')->toArray(),
                    );

                    $animal = $service->findByName($name, $type)->first();
                } else {
                    $animal = $match->first();
                }

                $this->line('Result:');
                foreach (['name', 'type_name', 'is_imaginary', 'says'] as $attr) {
                    $this->line(sprintf('%14s: %s', Str::studly($attr), $animal->$attr ?? '??'));
                }
            }
            // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            $this->error('Something went wrong!');
            $this->error($e->getMessage());
        }
        // @codeCoverageIgnoreEnd
    }
}
