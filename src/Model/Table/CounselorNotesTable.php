<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CounselorNotes Model
 *
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\BelongsTo $Assessments
 *
 * @method \App\Model\Entity\CounselorNote newEmptyEntity()
 * @method \App\Model\Entity\CounselorNote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CounselorNote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CounselorNote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CounselorNote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CounselorNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CounselorNote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CounselorNote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CounselorNote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CounselorNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CounselorNote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CounselorNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CounselorNote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CounselorNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CounselorNote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CounselorNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CounselorNote> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CounselorNotesTable extends Table
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

        $this->setTable('counselor_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Counselors', [
    'className'  => 'Users',
    'foreignKey' => 'counselor_id',
    'joinType'   => 'LEFT',
]);

		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
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
    ])
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
            ->integer('counselor_id')
            ->requirePresence('counselor_id', 'create')
            ->notEmptyString('counselor_id');

        $validator
            ->scalar('clinical_note')
            ->allowEmptyString('clinical_note');

        $validator
            ->scalar('action_taken')
            ->allowEmptyString('action_taken');

        $validator
            ->date('follow_up_date')
            ->allowEmptyDate('follow_up_date');

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

        return $rules;
    }
}
