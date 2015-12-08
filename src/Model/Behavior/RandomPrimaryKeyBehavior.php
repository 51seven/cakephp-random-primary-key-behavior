<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Exception\Exception;

class RandomPrimaryKeyBehavior extends Behavior
{

  protected $_defaultConfig = [
    'repository' => false,
    'column' => 'id',
    'range' => [
      'start' => 10000,
      'end' => 9999999
    ]
  ];

  public function beforeSave(Event $event, Entity $entity) {
    $config = $this->config();

    if(!$config['repository']) {
      throw new Exception('No repository specified.');
    }

    if(!isset($entity[$config['column']])) {
      $id = mt_rand($config['range']['start'], $config['range']['end']);

      if(!$id) {
        return $entity;
      }

      $table = TableRegistry::get($config['repository']);

      $results = $table->find();
      $results->where([$config['repository'].".".$config['column'] => $id]);

      if($results->count() == 0) {
        $entity[$config['column']] = $id;
      }
    }

    return $entity;
  }
}
?>
