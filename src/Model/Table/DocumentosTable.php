<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Documentos Model
 *
 * @property \App\Model\Table\PostulantesTable&\Cake\ORM\Association\BelongsTo $Postulantes
 *
 * @method \App\Model\Entity\Documento newEmptyEntity()
 * @method \App\Model\Entity\Documento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Documento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Documento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Documento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Documento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Documento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Documento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Documento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Documento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Documento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Documento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Documento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DocumentosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('documentos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Postulantes', [
            'foreignKey' => 'postulante_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Proyectos', [
            'foreignKey' => 'proyecto_id',
            'joinType' => 'INNER',
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
                ->integer('postulante_id')
                ->requirePresence('postulante_id', 'create')
                ->notEmptyString('postulante_id');
        
        $validator
                ->integer('proyecto_id')
                ->requirePresence('proyecto_id', 'create')
                ->notEmptyString('proyecto_id');

        $validator
                ->scalar('nombre')
                ->maxLength('nombre', 255)
                ->requirePresence('nombre', 'create')
                ->notEmptyString('nombre');

        $validator
                ->scalar('detalles')
                ->requirePresence('detalles', 'create')
                ->allowEmptyString('detalles');

        $validator
                ->scalar('file')
                ->requirePresence('file', 'create');

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
