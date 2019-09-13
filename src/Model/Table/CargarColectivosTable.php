<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CargarColectivos Model
 *
 * @method \App\Model\Entity\CargarColectivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\CargarColectivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CargarColectivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CargarColectivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CargarColectivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CargarColectivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CargarColectivo findOrCreate($search, callable $callback = null)
 */
class CargarColectivosTable extends Table
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

        $this->table('cargar_colectivos');
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
            ->integer('id_colectivo')
            ->requirePresence('id_colectivo', 'create')
            ->notEmpty('id_colectivo');

        $validator
            ->integer('id_inscripcion')
            ->requirePresence('id_inscripcion', 'create')
            ->notEmpty('id_inscripcion');

        $validator
            ->integer('id_evento')
            ->requirePresence('id_evento', 'create')
            ->notEmpty('id_evento');

        $validator
            ->date('vaciar')
            ->allowEmpty('vaciar');

        return $validator;
    }
}
