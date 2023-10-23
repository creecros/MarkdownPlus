<?php

namespace Kanboard\Plugin\MarkdownPlus\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Model\UserMetadataModel;

class CheckboxController extends BaseController
{
    /*
    # must match
    + [x] 2
    * [ ] 3 
    > - [ ] 1
    + [x] 2
    * [ ] 3 
    > > * * [ ] 3 
    > * > * * [ ] 3 
    [ ] test 8

    # must not match:

    - [x]1
    + [ ]
    test [x]  
    test [x]  
    [] test 3  
    [a] test  
    [x](www.google.de) test4
    */

    private const regexCheckbox = '/^([+,\-,*,>, ] )*(\[[x, ]\] )/m';

    private function findCheckBox($text, $number, &$offset)
    {
        $count = preg_match_all(self::regexCheckbox, $text, $matches, PREG_OFFSET_CAPTURE); // find any remaining box
        $offset += $count;

        if ($offset >= $number) {
            return array(
                'success' => true,
                'offset' => end($matches) // the actual box [ ]/[x]
                [$count - $offset + $number - 1] // the requested checkbox
                [1] + 1 // the offset to the checkbox content
            );
        }
        return array('success' => false);
    }

    private function togglechar(&$string, $offset)
    {
        if ($string[$offset] === ' ') {
            $string[$offset] = 'x';
        } else {
            $string[$offset] = ' ';
        }
    }

    public function toggle()
    {
        $values = $this->request->getJson();
        $taskId = $values['task_id'];

        if (isset($taskId)) {
            $task = $this->taskFinderModel->getById($taskId);

            if ($task) {
                $foundCheckboxes = 0;
                $number = intval($values['number']);

                $text = $task['description'];
                $result = $this->findCheckBox($text, $number, $foundCheckboxes);
                if ($result['success']) {
                    $this->togglechar($text, $result['offset']);
                    $task['description'] = $text;
                    $this->taskModificationModel->update($task);
                    return;
                }

                if (isset($this->container["definitionOfDoneModel"])) {
                    foreach ($this->definitionOfDoneModel->getAll($taskId) as $subtask) {
                        $dod = $this->definitionOfDoneModel->getById($subtask['id']);

                        $result = $this->findCheckBox($dod['title'], $number, $foundCheckboxes);
                        if ($result['success']) {
                            $this->togglechar($dod['title'], $result['offset']);
                            $this->definitionOfDoneModel->save($dod);
                            return;
                        }

                        $result = $this->findCheckBox($dod['text'], $number, $foundCheckboxes);
                        if ($result['success']) {
                            $this->togglechar($dod['text'], $result['offset']);
                            $this->definitionOfDoneModel->save($dod);
                            return;
                        }
                    }
                }

                if (isset($this->container["subtaskResultModel"])) {
                    foreach ($this->subtaskModel->getAll($taskId) as $subtask) {
                        $text = $this->subtaskResultModel->getById($subtask['id']);
                        $result = $this->findCheckBox($text, $number, $foundCheckboxes);
                        if ($result['success']) {
                            $this->togglechar($text, $result['offset']);
                            $this->subtaskResultModel->Save($subtask['id'], $text);
                            return;
                        }
                    }
                }

                $commentSortingDirection = $this->userMetadataCacheDecorator->get(UserMetadataModel::KEY_COMMENT_SORTING_DIRECTION, 'ASC');

                foreach ($this->commentModel->getAll($taskId, $commentSortingDirection) as $comment) {
                    $text = $comment['comment'];

                    $result = $this->findCheckBox($text, $number, $foundCheckboxes);

                    if ($result['success']) {
                        $this->togglechar($text, $result['offset']);
                        $comment['comment'] = $text;
                        $this->commentModel->update($comment);
                        return;
                    }
                }
            }
        }
    }
}
