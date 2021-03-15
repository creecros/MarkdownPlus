<?php

namespace Kanboard\Plugin\MarkdownPlus\Helper;

use ParsedownCheckbox;
use Pimple\Container;

/**
 * Specific Markdown rules for Kanboard
 *
 * @package core
 * @author  norcnorc
 * @author  Frederic Guillot
 * @ KB v1.2.18
 * @additions Craig Crosby
 */
class CoreMarkdown extends ParsedownCheckbox
{
    /**
     * Task links generated will use the project token instead
     *
     * @access private
     * @var boolean
     */
    private $isPublicLink = false;

    /**
     * Container
     *
     * @access private
     * @var Container
     */
    private $container;

    /**
     * Constructor
     *
     * @access public
     * @param  Container  $container
     * @param  boolean    $isPublicLink
     */
    public function __construct(Container $container, $isPublicLink)
    {
        $this->isPublicLink = $isPublicLink;
        $this->container = $container;
        $this->InlineTypes['#'][] = 'TaskLink';
        $this->InlineTypes['@'][] = 'UserLink';
        $this->inlineMarkerList .= '#@';
        array_unshift($this->BlockTypes['['], 'Checkbox'); //added to the construct to get Parsedown Checkbox to function
    }

    /**
     * Handle Task Links
     *
     * Replace "#123" by a link to the task
     *
     * @access public
     * @param  array  $Excerpt
     * @return array|null
     */
    protected function inlineTaskLink(array $Excerpt)
    {
        if (preg_match('!#(\d+)!i', $Excerpt['text'], $matches)) {
            $link = $this->buildTaskLink($matches[1]);

            if (! empty($link)) {
                return array(
                    'extent' => strlen($matches[0]),
                    'element' => array(
                        'name' => 'a',
                        'text' => $matches[0],
                        'attributes' => array('href' => $link),
                    ),
                );
            }
        }

        return null;
    }

    /**
     * Handle User Mentions
     *
     * Replace "@username" by a link to the user
     *
     * @access public
     * @param  array  $Excerpt
     * @return array|null
     */
    protected function inlineUserLink(array $Excerpt)
    {
        if (! $this->isPublicLink && preg_match('/^@([^\s,!:?]+)/', $Excerpt['text'], $matches)) {
            $username = rtrim($matches[1], '.');
            $user = $this->container['userCacheDecorator']->getByUsername($username);

            if (! empty($user)) {
                $url = $this->container['helper']->url->to('UserViewController', 'profile', array('user_id' => $user['id']));
                $name = $user['name'] ?: $user['username'];

                return array(
                    'extent'  => strlen($username) + 1,
                    'element' => array(
                        'name'       => 'a',
                        'text'       => '@' . $username,
                        'attributes' => array(
                            'href'  => $url,
                            'class' => 'user-mention-link',
                            'title' => $name,
                            'aria-label' => $name,
                        ),
                    ),
                );
            }
        }

        return null;
    }

    /**
     * Build task link
     *
     * @access private
     * @param  integer $task_id
     * @return string
     */
    private function buildTaskLink($task_id)
    {
        if ($this->isPublicLink) {
            $token = $this->container['memoryCache']->proxy($this->container['taskFinderModel'], 'getProjectToken', $task_id);

            if (! empty($token)) {
                return $this->container['helper']->url->to(
                    'TaskViewController',
                    'readonly',
                    array(
                        'token' => $token,
                        'task_id' => $task_id,
                    ),
                    '',
                    true
                );
            }

            return '';
        }

        return $this->container['helper']->url->to(
            'TaskViewController',
            'show',
            array('task_id' => $task_id)
        );
    }

    /**
     * Exclude from nesting task links and user mentions for links
     *
     * @param array $Excerpt
     * @return array|null
     */
    protected function inlineLink($Excerpt)
    {
        $Inline = parent::inlineLink($Excerpt);
        if (is_array($Inline)) {
            array_push($Inline['element']['nonNestables'], 'TaskLink', 'UserLink');
        }
        return $Inline;
    }
}