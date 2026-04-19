<?php

require_once ROOT_PATH . '/app/modules/feedback/feedback_model.php';

class FeedbackService
{
    private $feedbackModel;

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
    }

    // Helper function: Render stars based on rating value
    private function renderStars($rating)
    {
        $intRating = (int)$rating;
        return str_repeat('★', $intRating) . str_repeat('☆', 5 - $intRating);
    }

    // Helper function: Format rating value to 1 decimal place
    private function formatRating($rating)
    {
        return (float)number_format($rating, 1);
    }

    public function getTopFeedbacksForDisplay($limit = 6)
    {
        $feedbacks = $this->feedbackModel->getTopFeedbacks($limit);

        // Duyệt qua từng feedback để thêm thông tin stars, rating value
        foreach ($feedbacks as &$item) {
            $item['feedback_stars'] = $this->renderStars($item['rating']);
            $item['feedback_ratings'] = $this->formatRating($item['rating']);
        }

        return $feedbacks;
    }
}
