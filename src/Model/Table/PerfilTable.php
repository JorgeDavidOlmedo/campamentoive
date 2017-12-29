<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Perfil Model
 *
 * @method \App\Model\Entity\Perfil get($primaryKey, $options = [])
 * @method \App\Model\Entity\Perfil newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Perfil[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Perfil|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil findOrCreate($search, callable $callback = null)
 */
class PerfilTable extends Table
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

        $this->table('perfil');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Usuarios', [
           'foreignKey' => 'id_perfil'
       ]);

       $this->hasMany('DetallePerfil', [
          'foreignKey' => 'id_perfil'
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
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');*/

        return $validator;
    }
}
