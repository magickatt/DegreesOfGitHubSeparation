<?php

namespace spec\Separation\Path\Factory;

use Separation\Path\Factory\RepositoryFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositoryFactorySpec extends ObjectBehavior
{
    function it_should_create_a_repository_from_an_array_of_data()
    {
        $data = array(
            'id' => '17587579',
            'name' => 'comparator',
            'full_name' => 'stof/comparator',
            'owner' => Array(
                'login' => 'stof',
                'id' => 439401,
                'avatar_url' => 'https://avatars.githubusercontent.com/u/439401?v=3',
                'gravatar_id' => null,
                'url' => 'https://api.github.com/users/stof',
                'html_url' => 'https://github.com/stof',
                'followers_url' => 'https://api.github.com/users/stof/followers',
                'following_url' => 'https://api.github.com/users/stof/following{/other_user}',
                'gists_url' => 'https://api.github.com/users/stof/gists{/gist_id}',
                'starred_url' => 'https://api.github.com/users/stof/starred{/owner}{/repo}',
                'subscriptions_url' => 'https://api.github.com/users/stof/subscriptions',
                'organizations_url' => 'https://api.github.com/users/stof/orgs',
                'repos_url' => 'https://api.github.com/users/stof/repos',
                'events_url' => 'https://api.github.com/users/stof/events{/privacy}',
                'received_events_url' => 'https://api.github.com/users/stof/received_events',
                'type' => 'User',
                'site_admin' => null,
            ),
            'private' => null,
            'html_url' => 'https://github.com/stof/comparator',
            'description' => 'Provides the functionality to compare PHP values for equality.',
            'fork' => 1,
            'url' => 'https://api.github.com/repos/stof/comparator',
            'forks_url' => 'https://api.github.com/repos/stof/comparator/forks',
            'keys_url' => 'https://api.github.com/repos/stof/comparator/keys{/key_id}',
            'collaborators_url' => 'https://api.github.com/repos/stof/comparator/collaborators{/collaborator}',
            'teams_url' => 'https://api.github.com/repos/stof/comparator/teams',
            'hooks_url' => 'https://api.github.com/repos/stof/comparator/hooks',
            'issue_events_url' => 'https://api.github.com/repos/stof/comparator/issues/events{/number}',
            'events_url' => 'https://api.github.com/repos/stof/comparator/events',
            'assignees_url' => 'https://api.github.com/repos/stof/comparator/assignees{/user}',
            'branches_url' => 'https://api.github.com/repos/stof/comparator/branches{/branch}',
            'tags_url' => 'https://api.github.com/repos/stof/comparator/tags',
            'blobs_url' => 'https://api.github.com/repos/stof/comparator/git/blobs{/sha}',
            'git_tags_url' => 'https://api.github.com/repos/stof/comparator/git/tags{/sha}',
            'git_refs_url' => 'https://api.github.com/repos/stof/comparator/git/refs{/sha}',
            'trees_url' => 'https://api.github.com/repos/stof/comparator/git/trees{/sha}',
            'statuses_url' => 'https://api.github.com/repos/stof/comparator/statuses/{sha}',
            'languages_url' => 'https://api.github.com/repos/stof/comparator/languages',
            'stargazers_url' => 'https://api.github.com/repos/stof/comparator/stargazers',
            'contributors_url' => 'https://api.github.com/repos/stof/comparator/contributors',
            'subscribers_url' => 'https://api.github.com/repos/stof/comparator/subscribers',
            'subscription_url' => 'https://api.github.com/repos/stof/comparator/subscription',
            'commits_url' => 'https://api.github.com/repos/stof/comparator/commits{/sha}',
            'git_commits_url' => 'https://api.github.com/repos/stof/comparator/git/commits{/sha}',
            'comments_url' => 'https://api.github.com/repos/stof/comparator/comments{/number}',
            'issue_comment_url' => 'https://api.github.com/repos/stof/comparator/issues/comments{/number}',
            'contents_url' => 'https://api.github.com/repos/stof/comparator/contents/{+path}',
            'compare_url' => 'https://api.github.com/repos/stof/comparator/compare/{base}...{head}',
            'merges_url' => 'https://api.github.com/repos/stof/comparator/merges',
            'archive_url' => 'https://api.github.com/repos/stof/comparator/{archive_format}{/ref}',
            'downloads_url' => 'https://api.github.com/repos/stof/comparator/downloads',
            'issues_url' => 'https://api.github.com/repos/stof/comparator/issues{/number}',
            'pulls_url' => 'https://api.github.com/repos/stof/comparator/pulls{/number}',
            'milestones_url' => 'https://api.github.com/repos/stof/comparator/milestones{/number}',
            'notifications_url' => 'https://api.github.com/repos/stof/comparator/notifications{?since,all,participating}',
            'labels_url' => 'https://api.github.com/repos/stof/comparator/labels{/name}',
            'releases_url' => 'https://api.github.com/repos/stof/comparator/releases{/id}',
            'deployments_url' => 'https://api.github.com/repos/stof/comparator/deployments',
            'created_at' => '2014-03-10T09:30:11Z',
            'updated_at' => '2014-03-10T09:52:14Z',
            'pushed_at' => '2014-03-10T09:52:14Z',
            'git_url' => 'git://github.com/stof/comparator.git',
            'ssh_url' => 'git@github.com:stof/comparator.git',
            'clone_url' => 'https://github.com/stof/comparator.git',
            'svn_url' => 'https://github.com/stof/comparator',
            'homepage' => null,
            'size' => 164,
            'stargazers_count' => 0,
            'watchers_count' => 0,
            'language' => 'PHP',
            'has_issues' => null,
            'has_downloads' => 1,
            'has_wiki' => null,
            'has_pages' => null,
            'forks_count' => 0,
            'mirror_url' => null,
            'open_issues_count' => 0,
            'forks' => 0,
            'open_issues' => 0,
            'watchers' => 0,
            'default_branch' => 'master'
        );

        $this->createFromData($data)->shouldBeAnInstanceOf('Separation\Repository');
    }
}
