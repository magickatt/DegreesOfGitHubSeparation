<?php

namespace spec\Separation\Path\Factory;

use Separation\Path\Factory\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserFactorySpec extends ObjectBehavior
{
    function it_should_create_a_user_from_an_array_of_data()
    {
        $data = array(
            'login' => 'vjeux',
            'id' => 197597,
            'avatar_url' => 'https://avatars.githubusercontent.com/u/197597?v=3',
            'gravatar_id' => null,
            'url' => 'https://api.github.com/users/vjeux',
            'html_url' => 'https://github.com/vjeux',
            'followers_url' => 'https://api.github.com/users/vjeux/followers',
            'following_url' => 'https://api.github.com/users/vjeux/following{/other_user}',
            'gists_url' => 'https://api.github.com/users/vjeux/gists{/gist_id}',
            'starred_url' => 'https://api.github.com/users/vjeux/starred{/owner}{/repo}',
            'subscriptions_url' => 'https://api.github.com/users/vjeux/subscriptions',
            'organizations_url' => 'https://api.github.com/users/vjeux/orgs',
            'repos_url' => 'https://api.github.com/users/vjeux/repos',
            'events_url' => 'https://api.github.com/users/vjeux/events{/privacy}',
            'received_events_url' => 'https://api.github.com/users/vjeux/received_events',
            'type' => 'User',
            'site_admin' => null,
            'contributions' => 8,
        );

        $this->createFromData($data)->shouldBeAnInstanceOf('Separation\User');
    }
}
