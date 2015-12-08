# cakephp-random-primary-key-behavior
This Cakephp behavior automaticly creates a random digit primary key for your Model.

## install
Just copy the file into your Behavior folder (`src/Model/Behavior`)

Installation via Composer: Coming soon!

## how to use
Simly pase the following Code in your Table `initialize` Method:
```
public function initialize(array $config) {
  parent::initialize($config);
  
  $this->addBehavior('RandomPrimaryKey', [
    'repository' => 'EntityName',
    'column' => 'the_primary_key_column'
  ]);
}
```

## options
```
$config = [
    'repository' => false,
    'column' => 'id',
    'range' => [
      'start' => 10000,
      'end' => 9999999
    ]
];
```

you can pass the `$config` array as second parameter:
`$this->addBehavior('RandomPrimaryKey', $config`

