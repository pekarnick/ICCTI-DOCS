<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Event\EventInterface;
use ArrayObject;

/**
 * Proyectos Model
 *
 * @property \App\Model\Table\PostulantesTable&\Cake\ORM\Association\BelongsTo $Postulantes
 * @property \App\Model\Table\DocumentosTable&\Cake\ORM\Association\HasMany $Documentos
 *
 * @method \App\Model\Entity\Proyecto newEmptyEntity()
 * @method \App\Model\Entity\Proyecto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Proyecto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Proyecto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Proyecto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Proyecto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Proyecto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Proyecto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proyecto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proyecto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proyecto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proyecto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proyecto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProyectosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('proyectos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Postulantes', [
            'foreignKey' => 'postulante_id',
        ]);
        $this->hasMany('Documentos', [
            'foreignKey' => 'proyecto_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $valdator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options) {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = trim($value);
            }
        }
    }

    public function validationDefault(Validator $validator): Validator {
        $validator
                ->scalar('razon_social')
                ->maxLength('razon_social', 255)
                ->requirePresence('razon_social', 'create')
                ->notEmptyString('razon_social');

        $validator
                ->integer('cuit')
                ->requirePresence('cuit', 'create')
                ->notEmptyString('cuit');

        $validator
                ->scalar('domicilio_fiscal')
                ->requirePresence('domicilio_fiscal', 'create')
                ->notEmptyString('domicilio_fiscal');

        $validator
                ->scalar('telefono')
                ->maxLength('telefono', 20)
                ->requirePresence('telefono', 'create')
                ->notEmptyString('telefono');

        $validator
                ->scalar('localidad')
                ->maxLength('localidad', 255)
                ->requirePresence('localidad', 'create')
                ->notEmptyString('localidad');

        $validator
                ->scalar('actividad_principal')
                ->maxLength('actividad_principal', 150)
                ->requirePresence('actividad_principal', 'create')
                ->notEmptyString('actividad_principal');

        $validator
                ->scalar('categoria_mypyme')
                ->maxLength('categoria_mypyme', 3)
                ->requirePresence('categoria_mypyme', 'create')
                ->notEmptyString('categoria_mypyme');

        $validator
                ->integer('cantidad_total_de_empleados')
                ->requirePresence('cantidad_total_de_empleados', 'create')
                ->notEmptyString('cantidad_total_de_empleados');

        $validator
                ->scalar('representante_legal_nombre')
                ->maxLength('representante_legal_nombre', 255)
                ->requirePresence('representante_legal_nombre', 'create')
                ->notEmptyString('representante_legal_nombre');

        $validator
                ->integer('representante_legal_cuit_cuil')
                ->requirePresence('representante_legal_cuit_cuil', 'create')
                ->notEmptyString('representante_legal_cuit_cuil');

        $validator
                ->scalar('representante_legal_telefono')
                ->maxLength('representante_legal_telefono', 20)
                ->requirePresence('representante_legal_telefono', 'create')
                ->notEmptyString('representante_legal_telefono');

        $validator
                ->scalar('proyecto_titulo')
                ->maxLength('proyecto_titulo', 255)
                ->requirePresence('proyecto_titulo', 'create')
                ->notEmptyString('proyecto_titulo');

        $validator
                ->scalar('proyecto_tipo')
                ->maxLength('proyecto_tipo', 45)
                ->requirePresence('proyecto_tipo', 'create')
                ->notEmptyString('proyecto_tipo');

        $validator
                ->scalar('proyecto_localidad')
                ->maxLength('proyecto_localidad', 255)
                ->requirePresence('proyecto_localidad', 'create')
                ->notEmptyString('proyecto_localidad');

        $validator
                ->scalar('proyecto_nombre_director')
                ->maxLength('proyecto_nombre_director', 25)
                ->requirePresence('proyecto_nombre_director', 'create')
                ->notEmptyString('proyecto_nombre_director');

        $validator
                ->decimal('proyecto_monto_solicitado')
                ->requirePresence('proyecto_monto_solicitado', 'create')
                ->notEmptyString('proyecto_monto_solicitado');

        $validator
                ->integer('postulante_id')
                ->allowEmptyString('postulante_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn('postulante_id', 'Postulantes'), ['errorField' => 'postulante_id']);

        return $rules;
    }

}
