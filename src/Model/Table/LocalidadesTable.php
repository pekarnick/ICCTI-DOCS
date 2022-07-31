<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Localidades Model
 *
 * @method \App\Model\Entity\Localidade newEmptyEntity()
 * @method \App\Model\Entity\Localidade newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Localidade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Localidade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Localidade findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Localidade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Localidade[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Localidade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Localidade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Localidade[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localidade[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localidade[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localidade[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LocalidadesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('localidades');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('localidad')
            ->maxLength('localidad', 255)
            ->requirePresence('localidad', 'create')
            ->notEmptyString('localidad');

        return $validator;
    }
}
