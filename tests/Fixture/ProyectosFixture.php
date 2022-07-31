<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProyectosFixture
 */
class ProyectosFixture extends TestFixture
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
                'razon_social' => 'Lorem ipsum dolor sit amet',
                'cuit' => 1,
                'domicilio_fiscal' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'telefono' => 'Lorem ipsum dolor ',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'actividad_principal' => 'Lorem ipsum dolor sit amet',
                'cantidad_total_de_empleados' => 1,
                'representante_legal_nombre' => 'Lorem ipsum dolor sit amet',
                'representante_legal_cuit_cuil' => 1,
                'representante_legal_telefono' => 'Lorem ipsum dolor ',
                'proyecto_titulo' => 'Lorem ipsum dolor sit amet',
                'proyecto_tipo' => 'Lorem ipsum dolor sit amet',
                'proyecto_localidad' => 'Lorem ipsum dolor sit amet',
                'proyecto_nombre_director' => 'Lorem ipsum dolor sit a',
                'proyecto_monto_solicitado' => 1.5,
                'postulante_id' => 1,
                'created' => '2022-05-10 17:18:07',
                'modified' => '2022-05-10 17:18:07',
            ],
        ];
        parent::init();
    }
}
