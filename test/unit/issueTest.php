<?php

require_once dirname(__FILE__).'/../../vendor/lime.php';
require_once dirname(__FILE__).'/../../lib/phpGitHubApi.php';

$t = new lime_test(6);

$username = 'ornicar';
$repo     = 'php-github-api';

$github = new phpGitHubApi(true);

$t->comment('List issues');

$issues = $github->getIssueApi()->getList($username, $repo, 'closed');

$t->is($issues[0]['state'], 'closed', 'Found closed issues');

$t->is_deeply($github->listIssues($username, $repo, 'closed'), $issues, 'Both new and BC syntax work');

$t->comment('Search issues');

$issues = $github->getIssueApi()->search($username, $repo, 'closed', 'documentation');

$t->is($issues[0]['state'], 'closed', 'Found closed issues matching "documentation"');

$t->is_deeply($github->searchIssues($username, $repo, 'closed', 'documentation'), $issues, 'Both new and BC syntax work');

$t->comment('Show issue');

$issue = $github->getIssueApi()->show($username, $repo, 1);

$t->is($issue['title'], 'Provide documentation', 'Found issue #1');

$t->is_deeply($github->showIssue($username, $repo, 1), $issue, 'Both new and BC syntax work');