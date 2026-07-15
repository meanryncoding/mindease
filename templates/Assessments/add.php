<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assessment $assessment
 */
?>
<!--Header-->
<div class="row text-body-secondary">
    <div class="col-12">
        <h1 class="my-0 page_title">How Are You Feeling Today? 🌿</h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
</div>
<div class="line mb-4"></div>

<style>
/* ── Progress bar ── */
.step-progress {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    position: relative;
}
.step-progress::before {
    content: '';
    position: absolute;
    top: 24px;
    left: 6%;
    right: 6%;
    height: 2px;
    background: #dee2e6;
    z-index: 0;
}
.step-item {
    text-align: center;
    position: relative;
    z-index: 1;
    flex: 1;
}
.step-circle {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.step-item.active .step-circle { background: #0F6E56; color: #fff; }
.step-item.done .step-circle { background: #1D9E75; color: #fff; }
.step-label { font-size: 0.85rem; font-weight: 600; }
.step-sub { font-size: 0.75rem; color: #6c757d; }
.step-item.active .step-label { color: #0F6E56; }

/* ── Section card ── */
.section-header {
    border-radius: 12px 12px 0 0;
    padding: 1.25rem 1.5rem;
    color: #fff;
}
.section-header h4 { margin: 0; font-weight: 700; }
.section-header p { margin: 0.25rem 0 0; opacity: 0.9; font-size: 0.9rem; }
.header-a { background: #0d6efd; }
.header-b { background: #f5a623; }
.header-c { background: #17c1e8; }
.header-d { background: #1D9E75; }

.question-code {
    font-weight: 700;
    color: #0F6E56;
    margin-right: 0.5rem;
}
.question-text { font-size: 0.95rem; font-weight: 500; margin-bottom: 0.75rem; }

/* ── Option buttons ── */
.option-row { display: flex; gap: 0.75rem; flex-wrap: wrap; }
.option-btn { flex: 1; min-width: 140px; }
.option-btn input[type="radio"] { display: none; }
.option-btn label {
    display: block;
    width: 100%;
    text-align: center;
    padding: 0.65rem 0.5rem;
    border: 1.5px solid #dee2e6;
    border-radius: 10px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.15s;
    color: var(--bs-body-color);
}
.option-btn label:hover { border-color: #1D9E75; background: #f0faf6; }
.option-btn input[type="radio"]:checked + label {
    border-color: #0F6E56;
    background: #0F6E56;
    color: #fff;
    font-weight: 600;
}

.question-block { padding: 1.25rem 0; border-bottom: 1px solid #f0f0f0; }
.question-block:last-child { border-bottom: none; }

.assessment-step { display: none; }
.assessment-step.active { display: block; }

.btn-nav {
    padding: 0.6rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
}
.btn-next { background: #f5a623; border: none; color: #fff; }
.btn-next:hover { background: #e09612; color: #fff; }
.btn-submit-assessment { background: #0F6E56; border: none; color: #fff; }
.btn-submit-assessment:hover { background: #0a5340; color: #fff; }
</style>

<!-- Progress -->
<div class="step-progress">
    <div class="step-item active" id="prog-1">
        <div class="step-circle">A</div>
        <div class="step-label">Depression</div>
        <div class="step-sub">PHQ-9</div>
    </div>
    <div class="step-item" id="prog-2">
        <div class="step-circle">B</div>
        <div class="step-label">Anxiety</div>
        <div class="step-sub">GAD-7</div>
    </div>
    <div class="step-item" id="prog-3">
        <div class="step-circle">C</div>
        <div class="step-label">Stress</div>
        <div class="step-sub">PSS-4</div>
    </div>
    <div class="step-item" id="prog-4">
        <div class="step-circle">D</div>
        <div class="step-label">Wellbeing</div>
        <div class="step-sub">General</div>
    </div>
</div>

<?= $this->Form->create($assessment, ['id' => 'assessmentForm']) ?>

<!-- ═══════════ STEP 1: SECTION A — PHQ-9 ═══════════ -->
<div class="assessment-step active" id="step-1">
    <div class="card border-0 shadow mb-4">
        <div class="section-header header-a">
            <h4>Section A — Depression Screening (PHQ-9)</h4>
            <p>Over the last 2 weeks, how often have you been bothered by any of the following?</p>
        </div>
        <div class="card-body px-4">
            <?php
            $sectionA = [
                'A1' => 'Little interest or pleasure in doing things',
                'A2' => 'Feeling down, depressed, or hopeless',
                'A3' => 'Trouble falling or staying asleep, or sleeping too much',
                'A4' => 'Feeling tired or having little energy',
                'A5' => 'Poor appetite or overeating',
                'A6' => 'Feeling bad about yourself or that you are a failure',
                'A7' => 'Trouble concentrating on things',
                'A8' => 'Moving or speaking slowly, or being fidgety or restless',
                'A9' => 'Thoughts that you would be better off dead or of hurting yourself',
            ];
            $scaleAB = [0 => 'Not at all (0)', 1 => 'Several days (1)', 2 => 'More than half (2)', 3 => 'Nearly every day (3)'];
            foreach ($sectionA as $code => $text): ?>
            <div class="question-block">
                <div class="question-text"><span class="question-code"><?= $code ?></span><?= $text ?></div>
                <div class="option-row">
                    <?php foreach ($scaleAB as $val => $label): ?>
                    <div class="option-btn">
                        <input type="radio" name="<?= $code ?>" id="<?= $code ?>_<?= $val ?>" value="<?= $val ?>" required>
                        <label for="<?= $code ?>_<?= $val ?>"><?= $label ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-nav btn-next" onclick="goToStep(2)">Next: Anxiety Assessment →</button>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════ STEP 2: SECTION B — GAD-7 ═══════════ -->
<div class="assessment-step" id="step-2">
    <div class="card border-0 shadow mb-4">
        <div class="section-header header-b">
            <h4>Section B — Anxiety Screening (GAD-7)</h4>
            <p>Over the last 2 weeks, how often have you been bothered by the following problems?</p>
        </div>
        <div class="card-body px-4">
            <?php
            $sectionB = [
                'B1' => 'Feeling nervous, anxious, or on edge',
                'B2' => 'Not being able to stop or control worrying',
                'B3' => 'Worrying too much about different things',
                'B4' => 'Trouble relaxing',
                'B5' => 'Being so restless that it is hard to sit still',
                'B6' => 'Becoming easily annoyed or irritable',
                'B7' => 'Feeling afraid as if something awful might happen',
            ];
            foreach ($sectionB as $code => $text): ?>
            <div class="question-block">
                <div class="question-text"><span class="question-code"><?= $code ?></span><?= $text ?></div>
                <div class="option-row">
                    <?php foreach ($scaleAB as $val => $label): ?>
                    <div class="option-btn">
                        <input type="radio" name="<?= $code ?>" id="<?= $code ?>_<?= $val ?>" value="<?= $val ?>" required>
                        <label for="<?= $code ?>_<?= $val ?>"><?= $label ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-nav btn-outline-secondary" onclick="goToStep(1)">← Back</button>
                <button type="button" class="btn btn-nav btn-next" onclick="goToStep(3)">Next: Stress Assessment →</button>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════ STEP 3: SECTION C — PSS-4 ═══════════ -->
<div class="assessment-step" id="step-3">
    <div class="card border-0 shadow mb-4">
        <div class="section-header header-c">
            <h4>Section C — Stress Screening (PSS-4)</h4>
            <p>In the last month, how often have you...</p>
        </div>
        <div class="card-body px-4">
            <?php
            $sectionC = [
                'C1' => 'Been upset because of something that happened unexpectedly',
                'C2' => 'Felt unable to control the important things in your life',
                'C3' => 'Felt nervous and stressed',
                'C4' => 'Felt difficulties were piling up so high you could not overcome them',
            ];
            $scaleC = [0 => 'Never (0)', 1 => 'Almost never (1)', 2 => 'Sometimes (2)', 3 => 'Fairly often (3)'];
            foreach ($sectionC as $code => $text): ?>
            <div class="question-block">
                <div class="question-text"><span class="question-code"><?= $code ?></span><?= $text ?></div>
                <div class="option-row">
                    <?php foreach ($scaleC as $val => $label): ?>
                    <div class="option-btn">
                        <input type="radio" name="<?= $code ?>" id="<?= $code ?>_<?= $val ?>" value="<?= $val ?>" required>
                        <label for="<?= $code ?>_<?= $val ?>"><?= $label ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-nav btn-outline-secondary" onclick="goToStep(2)">← Back</button>
                <button type="button" class="btn btn-nav btn-next" onclick="goToStep(4)">Next: Wellbeing Check →</button>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════ STEP 4: SECTION D — WELLBEING ═══════════ -->
<div class="assessment-step" id="step-4">
    <div class="card border-0 shadow mb-4">
        <div class="section-header header-d">
            <h4>Section D — General Wellbeing</h4>
            <p>A few final questions about your week</p>
        </div>
        <div class="card-body px-4">

            <!-- D1 -->
            <div class="question-block">
                <div class="question-text"><span class="question-code">D1</span>How many hours of sleep do you usually get per night this week?</div>
                <select name="D1" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="0">Less than 4 hours</option>
                    <option value="1">4–6 hours</option>
                    <option value="2">6–8 hours</option>
                    <option value="3">More than 8 hours</option>
                </select>
            </div>

            <!-- D2 -->
            <div class="question-block">
                <div class="question-text"><span class="question-code">D2</span>How would you rate your academic pressure level this week?</div>
                <select name="D2" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="0">Low</option>
                    <option value="1">Moderate</option>
                    <option value="2">High</option>
                    <option value="3">Very High</option>
                </select>
            </div>

            <!-- D3 -->
            <div class="question-block">
                <div class="question-text"><span class="question-code">D3</span>Do you have someone you can talk to when feeling down?</div>
                <select name="D3" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- D4 -->
            <div class="question-block">
                <div class="question-text"><span class="question-code">D4</span>How often have you felt lonely or isolated on campus this week?</div>
                <select name="D4" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="0">Never</option>
                    <option value="1">Sometimes</option>
                    <option value="2">Often</option>
                    <option value="3">Always</option>
                </select>
            </div>

            <!-- D5 -->
            <div class="question-block">
                <div class="question-text"><span class="question-code">D5</span>Have you engaged in any physical activity or exercise this week?</div>
                <select name="D5" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-nav btn-outline-secondary" onclick="goToStep(3)">← Back</button>
                <button type="submit" class="btn btn-nav btn-submit-assessment">✓ Submit Assessment</button>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<script>
function goToStep(step) {
    // Validate current step before moving forward
    var current = document.querySelector('.assessment-step.active');
    var stepNum = parseInt(current.id.replace('step-', ''));

    if (step > stepNum) {
        // Check required inputs in current step
        var inputs = current.querySelectorAll('input[required], select[required]');
        var radioGroups = {};
        var valid = true;

        inputs.forEach(function(input) {
            if (input.type === 'radio') {
                radioGroups[input.name] = radioGroups[input.name] || false;
                if (input.checked) radioGroups[input.name] = true;
            } else if (input.tagName === 'SELECT' && input.value === '') {
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        for (var name in radioGroups) {
            if (!radioGroups[name]) valid = false;
        }

        if (!valid) {
            alert('Please answer all questions before continuing.');
            return;
        }
    }

    // Switch step
    document.querySelectorAll('.assessment-step').forEach(function(el) {
        el.classList.remove('active');
    });
    document.getElementById('step-' + step).classList.add('active');

    // Update progress
    for (var i = 1; i <= 4; i++) {
        var prog = document.getElementById('prog-' + i);
        prog.classList.remove('active', 'done');
        if (i < step) prog.classList.add('done');
        if (i === step) prog.classList.add('active');
    }

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>