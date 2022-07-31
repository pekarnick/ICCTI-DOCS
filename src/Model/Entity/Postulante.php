<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Postulante Entity
 *
 * @property int $id
 * @property string $cuit
 * @property string $nombre
 * @property string $apellido
 * @property int $dni
 * @property string $telefono
 * @property string $email
 * @property string $direccion
 * @property string $localidad
 * @property string $provincia
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Documento[] $documentos
 * @property \App\Model\Entity\User[] $users
 */
class Postulante extends Entity {

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
        'cuit' => true,
        'nombre' => true,
        'apellido' => true,
        'telefono' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'documentos' => true,
        'users' => true,
    ];

    protected function _getFullName() {
        return $this->nombre . '  ' . $this->apellido." - ".$this->cuit;
    }

}
