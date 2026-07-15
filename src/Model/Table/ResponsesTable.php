<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Responses Model
 *
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\BelongsTo $Assessments
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\Response newEmptyEntity()
 * @method \App\Model\Entity\Response newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Response> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Response get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Response findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Response patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Response> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Response|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Response saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ResponsesTable extends Table
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

        $this->setTable('responses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER',
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
            ->integer('assessment_id')
            ->notEmptyString('assessment_id');

        $validator
            ->integer('question_id')
            ->notEmptyString('question_id');

        $validator
            ->allowEmptyString('response_value');

        $validator
            ->scalar('response_text')
            ->maxLength('response_text', 100)
            ->allowEmptyString('response_text');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['assessment_id'], 'Assessments'), ['errorField' => 'assessment_id']);
        $rules->add($rules->existsIn(['question_id'], 'Questions'), ['errorField' => 'question_id']);

        return $rules;
    }
}
