<?php

namespace App\Services;

use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\DuplicateAnimalNameException;
use App\Models\Animal as AnimalModel;
use App\Models\AnimalType as AnimalTypeModel;
use App\Types\Animals\Animal;
use App\Types\Animals\ImaginaryAnimal;
use App\Types\Animals\RealAnimal;
use App\Types\Sounds\GenericSound;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class AnimalService
{
    public function find(string $type): Animal
    {
        $className = sprintf('App\Types\Animals\%s', ucfirst(strtolower($type)));

        if (class_exists($className)) {
            return new $className;
        } else {
            if ($animalModel = $this->findTypeInDb($type)) {
                if ($animalModel->is_imaginary) {
                    return (new ImaginaryAnimal)
                        ->called($animalModel->name);
                } else {
                    return (new RealAnimal(new GenericSound($animalModel->sound)))
                        ->called($animalModel->name);
                }
            }
        }

        throw new AnimalNotFoundException($type);
    }

    public function findByName(string $name, string $type = null): Collection
    {
        $query = AnimalModel::where('name', $name);

        if (! empty($type)) {
            $query->whereHas('type', fn (Builder $query) => $query->where('name', $type));
        }

        return $query->get();
    }

    public function isImaginary(Animal $animal): bool
    {
        return $animal instanceof ImaginaryAnimal;
    }

    public function persist(string $name, Animal $animal): bool
    {
        $type = $animal->getName();

        try {
            $typeModel = $this->findTypeInDb($type);

            if (! $typeModel) {
                $typeModel = $this->saveNewType($animal);
            }

            AnimalModel::create([
                'name' => $name,
                'animal_type_id' => $typeModel->id,
            ]);

            return true;
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                throw new DuplicateAnimalNameException($name, $type);
            }

            // @codeCoverageIgnoreStart
            throw $e;
            // @codeCoverageIgnoreEnd
        }

        return false;
    }

    protected function saveNewType(Animal $animal): AnimalTypeModel
    {
        return AnimalTypeModel::create([
            'name' => $animal->getName(),
            'sound' => $animal->says(),
            'is_imaginary' => $this->isImaginary($animal),
        ]);
    }

    protected function findTypeInDb(string $type): ?AnimalTypeModel
    {
        $in_db = AnimalTypeModel::where('name', $type);

        if ($in_db->exists()) {
            return $in_db->first();
        }

        return null;
    }
}
