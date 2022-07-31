<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MiscelaneasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('miscelaneas');
        $this->setDisplayField('clave');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {

        $validator
                ->scalar('clave')
                ->maxLength('clave', 200)
                ->requirePresence('clave', 'create')
                ->notEmptyString('clave');

        $validator
                ->scalar('valor')
                ->maxLength('clave', 200)
                ->requirePresence('valor', 'create')
                ->notEmptyString('valor');

        return $validator;
    }

}
