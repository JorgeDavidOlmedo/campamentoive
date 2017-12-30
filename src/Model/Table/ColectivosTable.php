<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Colectivos Model
 *
 * @method \App\Model\Entity\Colectivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Colectivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Colectivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Colectivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Colectivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Colectivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Colectivo findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ColectivosTable extends Table
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

        $this->table('colectivos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->integer('lugar')
            ->requirePresence('lugar', 'create')
            ->notEmpty('lugar');

        $validator
            ->integer('ocupado')
            ->requirePresence('ocupado', 'create')
            ->notEmpty('ocupado');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        return $validator;
    }
}
