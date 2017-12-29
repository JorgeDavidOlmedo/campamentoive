<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsuariosEmpresas Model
 *
 * @method \App\Model\Entity\UsuariosEmpresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsuariosEmpresa findOrCreate($search, callable $callback = null)
 */
class UsuariosEmpresasTable extends Table
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

        $this->table('usuarios_empresas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'id_usuario'
        ]);

        $this->belongsTo('Empresas', [
            'foreignKey' => 'id_empresa'
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

        $validator
            ->integer('id_usuario')
            ->requirePresence('id_usuario', 'create')
            ->notEmpty('id_usuario');

        $validator
            ->integer('id_empresa')
            ->requirePresence('id_empresa', 'create')
            ->notEmpty('id_empresa');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        return $validator;
    }
}
