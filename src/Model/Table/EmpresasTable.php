<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empresas Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Usuarios
 *
 * @method \App\Model\Entity\Empresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa findOrCreate($search, callable $callback = null)
 */
class EmpresasTable extends Table
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

        $this->table('empresas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Usuarios', [
            'foreignKey' => 'empresa_id',
            'targetForeignKey' => 'usuario_id',
            'joinTable' => 'usuarios_empresas'
        ]);

        $this->hasMany('Locales', [
            'foreignKey' => 'id_empresa'
        ]);

         $this->hasMany('Clientes', [
            'foreignKey' => 'id_empresa'
        ]);

        $this->hasMany('Proveedores', [
            'foreignKey' => 'id_empresa'
        ]);

        $this->hasMany('Camareros', [
            'foreignKey' => 'id_empresa'
        ]);


        $this->hasMany('CuentasCajas', [
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

        /*$validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->requirePresence('ruc', 'create')
            ->notEmpty('ruc');

        $validator
            ->requirePresence('dv', 'create')
            ->notEmpty('dv');

        $validator
            ->requirePresence('telefono', 'create')
            ->notEmpty('telefono');

        $validator
            ->requirePresence('direccion', 'create')
            ->notEmpty('direccion');

        $validator
            ->requirePresence('representante', 'create')
            ->notEmpty('representante','Debes completar el campo.');

        $validator
            ->requirePresence('ruc_representante', 'create')
            ->notEmpty('ruc_representante');

        $validator
            ->allowEmpty('estado');
*/
        return $validator;
    }
}
