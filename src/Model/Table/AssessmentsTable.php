<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assessments Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CounselorNotesTable&\Cake\ORM\Association\HasMany $CounselorNotes
 * @property \App\Model\Table\ResponsesTable&\Cake\ORM\Association\HasMany $Responses
 *
 * @method \App\Model\Entity\Assessment newEmptyEntity()
 * @method \App\Model\Entity\Assessment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Assessment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Assessment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Assessment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Assessment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Assessment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Assessment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assessment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assessment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assessment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assessment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assessment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Assessment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Assessment> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AssessmentsTable extends Table
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

        $this->setTable('assessments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CounselorNotes', [
            'foreignKey' => 'assessment_id',
        ]);
        $this->hasMany('Responses', [
            'foreignKey' => 'assessment_id',
        ]);
		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
    ->value('overall_risk')
    ->value('is_flagged')
    ->add('date_from', 'Search.Callback', [
    'callback' => function ($query, $args, $manager) {
        if (!empty($args['date_from'])) {
            $query->where(['Assessments.submitted_at >=' => $args['date_from'] . ' 00:00:00']);
        }
        return true;
    }
])
->add('date_to', 'Search.Callback', [
    'callback' => function ($query, $args, $manager) {
        if (!empty($args['date_to'])) {
            $query->where(['Assessments.submitted_at <=' => $args['date_to'] . ' 23:59:59']);
        }
        return true;
    }
])
    ->add('search', 'Search.Like', [
    'before'     => true,
    'after'      => true,
    'fieldMode'  => 'OR',
    'multiValue' => true,
    'multiValueSeparator' => '|',
    'comparison' => 'LIKE',
    'wildcardAny' => '*',
    'wildcardOne' => '?',
    'fields' => ['Users.fullname', 'Users.email'],
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->allowEmptyString('phq9_score');

        $validator
            ->allowEmptyString('gad7_score');

        $validator
            ->allowEmptyString('pss4_score');

        $validator
            ->scalar('depression_level')
            ->allowEmptyString('depression_level');

        $validator
            ->scalar('anxiety_level')
            ->allowEmptyString('anxiety_level');

        $validator
            ->scalar('stress_level')
            ->allowEmptyString('stress_level');

        $validator
            ->scalar('overall_risk')
            ->allowEmptyString('overall_risk');

        $validator
            ->allowEmptyString('is_flagged');

        $validator
            ->allowEmptyString('crisis_trigger');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('submitted_at')
            ->allowEmptyDateTime('submitted_at');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
