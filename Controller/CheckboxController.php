<?php

namespace Kanboard\Plugin\MarkdownPlus\Controller;

use Kanboard\Controller\BaseController;

class CheckboxController extends BaseController
{
    private const regexCheckbox = '/\[[x, ]\]/m';

    private function findCheckBox($text, $number, &$offset)
    {
        $count = preg_match_all(self::regexCheckbox, $text, $matches, PREG_OFFSET_CAPTURE); // find any remaining box
        $offset += $count;

        if ($offset >= $number)
        {
            return array(
                'success' => true,
                'offset' => $matches[0][$count - $offset + $number - 1][1] + 1
            );
        }
        return array('success' => false);
    }

    private function togglechar(&$string, $offset)
    {
        if ($string[$offset] === ' ')
        {
            $string[$offset] = 'x';
        }
        else
        {
            $string[$offset] = ' ';
        }
    }

    public function toggle()
    {
        $values = $this->request->getJson();

        $foundCheckboxes = 0;
        $number = intval($values['number']);
        $taskId = $values['task_id'];

        if (isset($taskId))
        {
            $task = $this->taskFinderModel->getById($taskId);

            $text = $task['description'];

            $result = $this->findCheckBox($text, $number, $foundCheckboxes);

            if ($result['success'])
            {
                $this->togglechar($text, $result['offset']);
                $task['description'] = $text;
                $this->taskModificationModel->update($task);
                return;
            }

            foreach ($this->commentModel->getAll($taskId) as $comment)
            {
                $text = $comment['comment'];

                $result = $this->findCheckBox($text, $number, $foundCheckboxes);

                if ($result['success'])
                {
                    $this->togglechar($text, $result['offset']);
                    $comment['comment'] = $text;
                    $this->commentModel->update($comment);
                    return;
                }
            }
        }
    }
}
