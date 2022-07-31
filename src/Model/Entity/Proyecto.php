<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proyecto Entity
 *
 * @property int $id
 * @property string $razon_social
 * @property int $cuit
 * @property string $domicilio_fiscal
 * @property string $telefono
 * @property string $localidad
 * @property string $actividad_principal
 * @property int $cantidad_total_de_empleados
 * @property string $representante_legal_nombre
 * @property int $representante_legal_cuit_cuil
 * @property string $representante_legal_telefono
 * @property string $proyecto_titulo
 * @property string $proyecto_tipo
 * @property string $proyecto_localidad
 * @property string $proyecto_nombre_director
 * @property string $proyecto_monto_solicitado
 * @property int|null $postulante_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Postulante $postulante
 * @property \App\Model\Entity\Documento[] $documentos
 */
class Proyecto extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'razon_social' => true,
        'cuit' => true,
        'domicilio_fiscal' => true,
        'telefono' => true,
        'localidad' => true,
        'actividad_principal' => true,
        'cantidad_total_de_empleados' => true,
        'categoria_mypyme' => true,
        'representante_legal_nombre' => true,
        'representante_legal_cuit_cuil' => true,
        'representante_legal_telefono' => true,
        'proyecto_titulo' => true,
        'proyecto_tipo' => true,
        'proyecto_localidad' => true,
        'proyecto_nombre_director' => true,
        'proyecto_monto_solicitado' => true,
        'reportado' => true,
        'postulante_id' => true,
        'created' => true,
        'modified' => true,
        'postulante' => true,
        'documentos' => true,
    ];

//    protected function _getFullName() {
//        return $this->razon_social . '  ' . $this->apellido." - ".$this->cuit;
//    }
    protected function _getFullName() {
        return $this->id . ' - ' . $this->razon_social . " - " . $this->proyecto_titulo;
    }

}
