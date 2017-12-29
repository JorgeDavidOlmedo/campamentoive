<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Uuid Model
 *
 * @method \App\Model\Entity\Uuid get($primaryKey, $options = [])
 * @method \App\Model\Entity\Uuid newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Uuid[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Uuid|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Uuid patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Uuid[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Uuid findOrCreate($search, callable $callback = null)
 */
class UuidTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('uuid');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->requirePresence('usuario', 'create')
            ->notEmpty('usuario');

        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        return $validator;
    }
}
