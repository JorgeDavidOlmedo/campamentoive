<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetallePerfil Model
 *
 * @method \App\Model\Entity\DetallePerfil get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetallePerfil newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DetallePerfil[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetallePerfil|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetallePerfil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetallePerfil[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetallePerfil findOrCreate($search, callable $callback = null)
 */
class DetallePerfilTable extends Table
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

        $this->table('detalle_perfil');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Perfil', [
            'foreignKey' => 'id_perfil'
        ]);

        $this->belongsTo('Models', [
            'foreignKey' => 'id_model'
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
            ->integer('id_perfil')
            ->requirePresence('id_perfil', 'create')
            ->notEmpty('id_perfil');

        $validator
            ->integer('id_model')
            ->requirePresence('id_model', 'create')
            ->notEmpty('id_model');

        $validator
            ->integer('guardar')
            ->requirePresence('guardar', 'create')
            ->notEmpty('guardar');

        $validator
            ->integer('modificar')
            ->requirePresence('modificar', 'create')
            ->notEmpty('modificar');

        $validator
            ->integer('eliminar')
            ->requirePresence('eliminar', 'create')
            ->notEmpty('eliminar');

        $validator
            ->integer('consultar')
            ->requirePresence('consultar', 'create')
            ->notEmpty('consultar');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');*/

        return $validator;
    }
}
