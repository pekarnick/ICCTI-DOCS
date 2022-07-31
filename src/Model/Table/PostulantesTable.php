<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Postulantes Model
 *
 * @property \App\Model\Table\DocumentosTable&\Cake\ORM\Association\HasMany $Documentos
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Postulante newEmptyEntity()
 * @method \App\Model\Entity\Postulante newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Postulante[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Postulante get($primaryKey, $options = [])
 * @method \App\Model\Entity\Postulante findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Postulante patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Postulante[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Postulante|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Postulante saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Postulante[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Postulante[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Postulante[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Postulante[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostulantesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('postulantes');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Documentos', [
            'foreignKey' => 'postulante_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'postulante_id',
        ]);
        $this->hasMany('Proyectos', [
            'foreignKey' => 'postulante_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->scalar('cuit')
                ->maxLength('cuit', 13)
                ->requirePresence('cuit', 'create')
                ->notEmptyString('cuit');

        $validator
                ->scalar('nombre')
                ->maxLength('nombre', 100)
                ->requirePresence('nombre', 'create')
                ->notEmptyString('nombre');

        $validator
                ->scalar('apellido')
                ->maxLength('apellido', 100)
                ->requirePresence('apellido', 'create')
                ->notEmptyString('apellido');

        $validator
                ->scalar('telefono')
                ->maxLength('telefono', 45)
                ->requirePresence('telefono', 'create')
                ->notEmptyString('telefono');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmptyString('email');

        return $validator;
    }

}
