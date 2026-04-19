<?php

require_once ROOT_PATH . '/app/modules/feedback/feedback_service.php';

class FeedbackController
{
    private $feedbackService;

    public function __construct()
    {
        $this->feedbackService = new FeedbackService();
    }

    public function getTopFeedback()
    {
        return $this->feedbackService->getTopFeedbacksForDisplay(6);
    }
}
