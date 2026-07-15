<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \App\Model\Table\ResponsesTable&\Cake\ORM\Association\HasMany $Responses
 *
 * @method \App\Model\Entity\Question newEmptyEntity()
 * @method \App\Model\Entity\Question newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Question> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Question findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Question> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Question saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question> deleteManyOrFail(iterable $entities, array $options = [])
 */
class QuestionsTable extends Table
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

        $this->setTable('questions');
        $this->setDisplayField('section');
        $this->setPrimaryKey('id');

        $this->hasMany('Responses', [
            'foreignKey' => 'question_id',
        ]);
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
            ->scalar('section')
            ->requirePresence('section', 'create')
            ->notEmptyString('section');

        $validator
            ->scalar('question_code')
            ->maxLength('question_code', 5)
            ->requirePresence('question_code', 'create')
            ->notEmptyString('question_code');

        $validator
            ->scalar('question_text')
            ->requirePresence('question_text', 'create')
            ->notEmptyString('question_text');

        $validator
            ->scalar('response_type')
            ->requirePresence('response_type', 'create')
            ->notEmptyString('response_type');

        $validator
            ->requirePresence('max_score', 'create')
            ->notEmptyString('max_score');

        $validator
            ->allowEmptyString('is_crisis_trigger');

        $validator
            ->requirePresence('order_num', 'create')
            ->notEmptyString('order_num');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        return $validator;
    }
}
