<?php

namespace spec\Separation\Payload;

use PhpCollection\Sequence;
use Separation\Path\Path;
use Separation\Repository;
use Separation\ResponsePayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\User;

class ResponsePayloadSpec extends ObjectBehavior
{
    private $path;

    function let(Path $path)
    {
        $this->path = $path;
        $this->beConstructedWith($path);
    }

    function it_should_have_data_and_metadata_based_on_the_path_between_two_users()
    {
        $user1 = new User('archer');
        $user2 = new User('lana');
        $repositories = new Sequence([new Repository('ham/burger'), new Repository('cheese/burger'), new Repository('vege/burger')]);

        $this->path->shortestDistance()->willReturn(3);
        $this->path->getRepositories()->willReturn($repositories);
        $this->path->getUser1()->willReturn($user1);
        $this->path->getUser2()->willReturn($user2);

        $this->generatePayload()->shouldHaveKey('data');
        $this->generatePayload()->shouldHaveKey('metadata');
        $this->generatePayload()->shouldHaveDistance(3);
        $this->generatePayload()->shouldHavePath($repositories);
        $this->generatePayload()->shouldHaveUsers($user1, $user2);
    }

    public function getMatchers()
    {
        return [
            'haveDistance' => function (array $subject, $distance) {
                if (array_key_exists('data', $subject) && array_key_exists('distance', $subject['data'])) {
                    return $subject['data']['distance'] == $distance;
                }
            },
            'havePath' => function (array $subject, Sequence $repositories) {
                if (array_key_exists('data', $subject) && array_key_exists('path', $subject['data'])) {
                    foreach ($subject['data']['path'] as $index => $repositoryName) {
                        $repository = $repositories->get($index);
                        if ($repository->getName() != $repositoryName) {
                            return false;
                        }
                    }
                    return true;
                }
            },
            'haveUsers' => function (array $subject, User $user1, User $user2) {
                if (array_key_exists('metadata', $subject) &&
                    array_key_exists('user1', $subject['metadata']) &&
                    array_key_exists('user2', $subject['metadata']))
                {
                    if ($subject['metadata']['user1'] == $user1->getUsername() &&
                        $subject['metadata']['user2'] == $user2->getUsername())
                    {
                        return true;
                    }
                    return false;
                }
            },
        ];
    }
}
