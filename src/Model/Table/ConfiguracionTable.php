<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configuracion Model
 *
 * @method \App\Model\Entity\Configuracion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Configuracion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Configuracion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Configuracion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Configuracion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Configuracion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Configuracion findOrCreate($search, callable $callback = null)
 */
class ConfiguracionTable extends Table
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

        $this->table('configuracion');
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
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->decimal('costo_voluntario')
            ->requirePresence('costo_voluntario', 'create')
            ->notEmpty('costo_voluntario');

        $validator
            ->decimal('costo_colaborador')
            ->requirePresence('costo_colaborador', 'create')
            ->notEmpty('costo_colaborador');

        $validator
            ->decimal('costo_participante')
            ->requirePresence('costo_participante', 'create')
            ->notEmpty('costo_participante');

        $validator
            ->integer('cupo_participante')
            ->requirePresence('cupo_participante', 'create')
            ->notEmpty('cupo_participante');

        $validator
            ->integer('cupo-voluntario')
            ->requirePresence('cupo-voluntario', 'create')
            ->notEmpty('cupo-voluntario');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        return $validator;
    }
}
