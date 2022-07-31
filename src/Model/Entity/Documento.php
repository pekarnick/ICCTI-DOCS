<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Documento Entity
 *
 * @property int $id
 * @property int $postulante_id
 * @property string $nombre
 * @property string $detalles
 * @property string $file
 * @property string|null $observaciones
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $estado
 *
 * @property \App\Model\Entity\Postulante $postulante
 */
class Documento extends Entity
{
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
        'postulante_id' => true,
        'proyecto_id' => true,
        'nombre' => true,
        'detalles' => true,
        'file' => true,
        'observaciones' => true,
        'created' => true,
        'modified' => true,
        'estado' => true,
        'postulante' => true,
    ];
}
