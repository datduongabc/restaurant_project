<?php

require_once ROOT_PATH . '/app/modules/feedback/feedback_controller.php';

$feedback_controller = new FeedbackController();
$feedbacks = $feedback_controller->getTopFeedback();
?>

<!-- Feedback -->
<section class="py-5 bg-soft-cyan" id="feedback">
    <div class="container">
        <header class="text-center mb-5">
            <h2 class="fw-bold text-teal-dark">What did our customers say?</h2>
        </header>
        <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($feedbacks as $index => $feedback): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row justify-content-center px-lg-4">
                            <div class="col-12 col-md-8 col-lg-6 feedback-col mb-3">
                                <div class="card hover-card p-4 p-lg-5 text-center shadow-sm h-100">
                                    <div>
                                        <h3 class="fw-bold fs-3 mb-3">
                                            <i class="bi bi-person"></i>
                                            <?= htmlspecialchars($feedback['user_name']); ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <p class="text-teal-dark fw-semibold mb-3">
                                            Food reviewed: <?= htmlspecialchars($feedback['product_name']); ?>
                                        </p>
                                        <p class="text-teal-dark fw-semibold mb-3">
                                            Comment: <?= htmlspecialchars($feedback['comment']); ?>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center gap-2 mt-auto">
                                        <p class="text-primary-orange fs-4 mb-0">
                                            <?= $feedback['feedback_stars']; ?>
                                        </p>
                                        <p class="text-muted fs-5 mb-0">
                                            <?= $feedback['feedback_ratings']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#feedbackCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#feedbackCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>

            <div class="carousel-indicators">
                <?php foreach ($feedbacks as $index => $feedback): ?>
                    <button
                        class="<?= $index === 0 ? 'active' : '' ?>"
                        type="button"
                        data-bs-target="#feedbackCarousel"
                        data-bs-slide-to="<?= $index ?>"
                        aria-current="<?= $index === 0 ? 'true' : 'false' ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
