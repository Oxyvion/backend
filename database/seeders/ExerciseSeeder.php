<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /** Inserta categorías y ejercicios básicos para poder usar SysType de inmediato. */
    public function run(): void
    {
        // Estos textos iniciales permiten practicar justo después de instalar la base.
        $exercises = [
            [
                'title' => 'Introducción a la programación',
                'category' => 'Programación',
                'difficulty' => 'Básico',
                'content' => 'Programar consiste en escribir instrucciones claras para que un computador resuelva una tarea. Un buen programa divide los problemas grandes en pasos pequeños, usa nombres fáciles de entender y comprueba los resultados antes de entregarlos.',
            ],
            [
                'title' => 'Conceptos de bases de datos',
                'category' => 'Bases de datos',
                'difficulty' => 'Básico',
                'content' => 'Una base de datos organiza información para consultarla y actualizarla. Las tablas guardan registros en filas y describen sus datos mediante columnas. Las claves permiten relacionar información y ayudan a evitar registros duplicados.',
            ],
            [
                'title' => 'Redes de computadores',
                'category' => 'Redes',
                'difficulty' => 'Básico',
                'content' => 'Una red conecta dispositivos para compartir información y servicios. Cada equipo utiliza una dirección para comunicarse con otros. Los protocolos establecen reglas comunes para que los mensajes lleguen al destino correcto.',
            ],
            [
                'title' => 'Sistemas operativos',
                'category' => 'Sistemas operativos',
                'difficulty' => 'Básico',
                'content' => 'El sistema operativo administra los recursos del computador y permite ejecutar aplicaciones. También organiza archivos, controla dispositivos y ofrece una forma de interactuar con el equipo.',
            ],
            [
                'title' => 'Seguridad de la información',
                'category' => 'Seguridad',
                'difficulty' => 'Básico',
                'content' => 'La seguridad informática protege los datos frente a accesos y cambios no autorizados. Usar contraseñas únicas, actualizar los programas y hacer copias de respaldo son hábitos sencillos que reducen riesgos.',
            ],
        ];

        foreach ($exercises as $exercise) {
            // Reutiliza la categoría si ya existe y la crea solo si hace falta.
            $category = Category::query()->firstOrCreate(['name' => $exercise['category']]);

            // El título funciona como clave para que ejecutar el seeder no duplique ejercicios.
            Exercise::query()->updateOrCreate(
                ['title' => $exercise['title']],
                [
                    'category_id' => $category->id,
                    'difficulty' => $exercise['difficulty'],
                    'content' => $exercise['content'],
                ],
            );
        }
    }
}
