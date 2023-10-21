## AnimalProject

- [Built with Laravel Sail](https://laravel.com/docs/10.x/sail)
- [Code linting with Laravel Pint](https://laravel.com/docs/10.x/pint)

## Installation

This project requires [Docker Desktop](https://www.docker.com/products/docker-desktop/) or compatible to run.

- Launch the container as a daemon with `./vendor/bin/sail up -d`
- Run the database migrations with `./vendor/bin/sail artisan migrate --seed`

## Linting

Run the linter: `./vendor/bin/sail pint`

## Tests

Execute the test suite, with coverage report: `./vendor/bin/sail test --coverage`

## Running

Because this application was built with Laravel, I leveraged the [Artisan Console](https://laravel.com/docs/10.x/artisan) to handle the command line execution.

- The signature for the primary command can be viewed with `./vendor/bin/sail artisan help animal:says`
- E.g. sail artisan animal:says "Mr Pickles" cat
- For extra credit, there is an optional switch `--save` that will persist your animal. Names are unique by animal type.
- E.g. `./vendor/bin/sail artisan animal:says "Mr Pickles" cat --save`
- Saved animal records can be viewed, see the `./vendor/bin/sail artisan help animal:find` specifications
- E.g. `./vendor/bin/sail artisan animal:find "Mr Pickles"`
- If more than one animal has the queried name, a prompt will ask which species you would like to view.
