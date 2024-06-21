<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Books Model
 *
 * @method \App\Model\Entity\Book newEmptyEntity()
 * @method \App\Model\Entity\Book newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Book> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Book findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Book> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Book saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Book>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Book>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Book>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Book> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Book>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Book>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Book>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Book> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BooksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('books');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('AuditStash.AuditLog');

        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->value('id')
            ->add('search', 'Search.Like', [
                //'before' => true,
                //'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '|',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'fields' => ['id'],
            ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('author')
            ->maxLength('author', 255)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }
}
