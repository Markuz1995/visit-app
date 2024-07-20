<?php

namespace App\Console\Commands;

use App\Models\Visit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateVisit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-visit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new visit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nombre = $this->askValid(
            'Ingrese el nombre:',
            'nombre',
            ['required', 'string']
        );

        $email = $this->askValid(
            'Ingrese el correo electrónico:',
            'email',
            ['required', 'email']
        );

        $latitud = $this->askValid(
            'Ingrese la latitud:',
            'latitud',
            ['required', 'numeric']
        );

        $longitud = $this->askValid(
            'Ingrese la longitud:',
            'longitud',
            ['required', 'numeric']
        );

        $visita = Visit::create([
            'name' => $nombre,
            'email' => $email,
            'latitude' => $latitud,
            'longitude' => $longitud,
        ]);

        $this->info('Visita creada correctamente!');
    }

    /**
     * Ask a question and validate the answer.
     *
     * @param string $question
     * @param string $field
     * @param array $rules
     * @return mixed
     */
    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);

        $validator = Validator::make([$field => $value], [$field => $rules]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first($field));
            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }
}
