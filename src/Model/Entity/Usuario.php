<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $rol
 * @property string $nombre
 * @property string $telefono
 * @property string $direccion
 * @property string $estado
 */
class Usuario extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    protected function _setPassword($value)
    {
        if(!empty($value))
        {
            $hash = new DefaultPasswordHasher();
            return $hash->hash($value);
        }
        else
        {
            $id_user = $this->_properties['id'];
            $user = TableRegistry::get('Usuarios')->recoverPassword($id_user);
            return $user;
        }
    }


    public function beforeSave(Event $event)
    {
        $entity = $event->data['entity'];

        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = sha1(Text::uuid());

            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);
        }
        return true;
    }
}
