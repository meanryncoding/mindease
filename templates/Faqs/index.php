<!--Header-->
<div class="row text-body-secondary">
    <div class="col-12">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.faq-section-title {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: #5b2d8e;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0eafa;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.faq-item {
    border-bottom: 1px solid #f0f0f0;
}
.faq-item:last-child { border-bottom: none; }
.faq-question {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 0;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--bs-body-color);
    text-decoration: none;
    gap: 0.75rem;
}
.faq-question:hover { color: #5b2d8e; }
.faq-question .faq-icon {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: #f0eafa;
    color: #5b2d8e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    flex-shrink: 0;
    transition: all 0.2s;
}
.faq-question[aria-expanded="true"] .faq-icon {
    background: #5b2d8e;
    color: #fff;
    transform: rotate(45deg);
}
.faq-answer {
    font-size: 0.875rem;
    color: #6c757d;
    line-height: 1.7;
    padding-bottom: 0.85rem;
    padding-left: 0.25rem;
}
.faq-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
}
.faq-empty {
    color: #adb5bd;
    font-size: 0.85rem;
    font-style: italic;
    padding: 0.5rem 0;
}
</style>

<div class="row g-4">

    <!-- General -->
    <div class="col-md-6">
        <div class="card faq-card">
            <div class="card-body p-4">
                <div class="faq-section-title">
                    <i class="fa-solid fa-circle-info"></i> General
                </div>
                <?php if (!empty($general) && count($general) > 0): ?>
                    <?php foreach ($general as $faq): ?>
                    <div class="faq-item">
                        <a class="faq-question" href="#faq-<?= h($faq->id) ?>" data-bs-toggle="collapse" aria-expanded="false">
                            <span><?= h($faq->question) ?></span>
                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                        </a>
                        <div class="collapse" id="faq-<?= h($faq->id) ?>">
                            <p class="faq-answer"><?= h($faq->answer) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="faq-empty">No questions yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Assessment -->
    <div class="col-md-6">
        <div class="card faq-card">
            <div class="card-body p-4">
                <div class="faq-section-title">
                    <i class="fa-solid fa-clipboard-question"></i> Assessment
                </div>
                <?php if (!empty($assessment) && count($assessment) > 0): ?>
                    <?php foreach ($assessment as $faq): ?>
                    <div class="faq-item">
                        <a class="faq-question" href="#faq-<?= h($faq->id) ?>" data-bs-toggle="collapse" aria-expanded="false">
                            <span><?= h($faq->question) ?></span>
                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                        </a>
                        <div class="collapse" id="faq-<?= h($faq->id) ?>">
                            <p class="faq-answer"><?= h($faq->answer) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="faq-empty">No questions yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Account -->
    <div class="col-md-6">
        <div class="card faq-card">
            <div class="card-body p-4">
                <div class="faq-section-title">
                    <i class="fa-solid fa-user-circle"></i> Account
                </div>
                <?php if (!empty($account) && count($account) > 0): ?>
                    <?php foreach ($account as $faq): ?>
                    <div class="faq-item">
                        <a class="faq-question" href="#faq-<?= h($faq->id) ?>" data-bs-toggle="collapse" aria-expanded="false">
                            <span><?= h($faq->question) ?></span>
                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                        </a>
                        <div class="collapse" id="faq-<?= h($faq->id) ?>">
                            <p class="faq-answer"><?= h($faq->answer) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="faq-empty">No questions yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Support -->
    <div class="col-md-6">
        <div class="card faq-card">
            <div class="card-body p-4">
                <div class="faq-section-title">
                    <i class="fa-solid fa-hands-holding-heart"></i> Support
                </div>
                <?php if (!empty($support) && count($support) > 0): ?>
                    <?php foreach ($support as $faq): ?>
                    <div class="faq-item">
                        <a class="faq-question" href="#faq-<?= h($faq->id) ?>" data-bs-toggle="collapse" aria-expanded="false">
                            <span><?= h($faq->question) ?></span>
                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                        </a>
                        <div class="collapse" id="faq-<?= h($faq->id) ?>">
                            <p class="faq-answer"><?= h($faq->answer) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="faq-empty">No questions yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Others -->
    <?php if (!empty($other) && count($other) > 0): ?>
    <div class="col-md-6">
        <div class="card faq-card">
            <div class="card-body p-4">
                <div class="faq-section-title">
                    <i class="fa-solid fa-ellipsis"></i> Others
                </div>
                <?php foreach ($other as $faq): ?>
                <div class="faq-item">
                    <a class="faq-question" href="#faq-<?= h($faq->id) ?>" data-bs-toggle="collapse" aria-expanded="false">
                        <span><?= h($faq->question) ?></span>
                        <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                    </a>
                    <div class="collapse" id="faq-<?= h($faq->id) ?>">
                        <p class="faq-answer"><?= h($faq->answer) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

