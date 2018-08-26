<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EquipoTmp Model
 *
 * @method \App\Model\Entity\EquipoTmp get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipoTmp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipoTmp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipoTmp|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipoTmp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipoTmp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipoTmp findOrCreate($search, callable $callback = null)
 */
class EquipoTmpTable extends Table
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

        $this->table('equipo_tmp');
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
            ->integer('contador')
            ->requirePresence('contador', 'create')
            ->notEmpty('contador');

        $validator
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->requirePresence('sexo', 'create')
            ->notEmpty('sexo');

        $validator
            ->integer('edad')
            ->requirePresence('edad', 'create')
            ->notEmpty('edad');

        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('obs', 'create')
            ->notEmpty('obs');

        $validator
            ->integer('id_evento')
            ->requirePresence('id_evento', 'create')
            ->notEmpty('id_evento');

        return $validator;
    }
}
