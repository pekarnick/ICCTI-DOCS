<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostulantesFixture
 */
class PostulantesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'cuit' => 'Lorem ipsum',
                'nombre' => 'Lorem ipsum dolor sit amet',
                'apellido' => 'Lorem ipsum dolor sit amet',
                'dni' => 1,
                'telefono' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'direccion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'provincia' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-04-26 17:35:42',
                'modified' => '2022-04-26 17:35:42',
            ],
        ];
        parent::init();
    }
}
