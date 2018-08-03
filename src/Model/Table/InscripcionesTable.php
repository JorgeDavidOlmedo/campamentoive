<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inscripciones Model
 *
 * @method \App\Model\Entity\Inscripcione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inscripcione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inscripcione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inscripcione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inscripcione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inscripcione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inscripcione findOrCreate($search, callable $callback = null)
 */
class InscripcionesTable extends Table
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

        $this->table('inscripciones');
        $this->displayField('id');
        $this->primaryKey('id');


        $this->belongsTo('Personas', [
            'foreignKey' => 'id_persona'
        ]);

        $this->belongsTo('Colectivos', [
            'foreignKey' => 'id_colectivo'
        ]);
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

        /*$validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->integer('id_persona')
            ->requirePresence('id_persona', 'create')
            ->notEmpty('id_persona');

        $validator
            ->integer('id_colectivo')
            ->requirePresence('id_colectivo', 'create')
            ->notEmpty('id_colectivo');

        $validator
            ->decimal('pago')
            ->requirePresence('pago', 'create')
            ->notEmpty('pago');

        $validator
            ->decimal('deuda')
            ->requirePresence('deuda', 'create')
            ->notEmpty('deuda');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('observacion', 'create')
            ->notEmpty('observacion');

        $validator
            ->dateTime('fecha_cierre')
            ->requirePresence('fecha_cierre', 'create')
            ->notEmpty('fecha_cierre');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');*/

        return $validator;
    }
}
