<?php


namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;
    /**
     * @var Client
     */
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('this is a message sent from slack' , [
            'message' => $message
        ]);

        $slackMessage = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->slack->sendMessage($slackMessage);
    }

}