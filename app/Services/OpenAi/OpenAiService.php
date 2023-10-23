<?php

namespace App\Services\OpenAi;

use App\Services\OpenAi\Contracts\OpenAiServiceContract;
use DayRev\Summarizer\Provider;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class OpenAiService implements OpenAiServiceContract
{
    private const QUEUE = 'summary_news';
    private const DIRECT_EXCHANGE = 'amq.direct';

    private const QUEUE_WITH_SUMMARY = 'news_summary_made';
    private const BIND_QUEUE_WITH_SUMMARY = 'news_summary_made_queue';

    public function __construct()
    {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getSummary(): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USERNAME'),
            env('RABBITMQ_PASSWORD')
        );

        $channel = $connection->channel();

        $channel->basic_consume(self::QUEUE, '', false, false, false, false, function ($message) {
            $messageDecode = json_decode($message->body);
            $this->makeSummary($messageDecode->news->content, $messageDecode->news_id);
        });

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function makeSummary($text, $newsId)
    {
        $summarizer = Provider::instance('smmry', ['api_key' => '900EF7C1FE']);
        $content = $summarizer->summarize($text);

        $this->sendMessageToQueueAmqp($content, $newsId);

        return $content;
    }

    private function sendMessageToQueueAmqp($message, $newsId)
    {
        $amqp = $this->getAmqpConnectionAndChannel();

        $this->amqpQueueDeclare($amqp['channel'], self::QUEUE_WITH_SUMMARY);

        $this->amqpQueueBind($amqp['channel'], self::QUEUE_WITH_SUMMARY, self::DIRECT_EXCHANGE, self::BIND_QUEUE_WITH_SUMMARY);

        $body = [
            'summary' => $message,
            'news_id' => $newsId,
        ];

        $amqp['channel']->basic_publish(
            new AMQPMessage(json_encode($body)),
            self::DIRECT_EXCHANGE,
            self::BIND_QUEUE_WITH_SUMMARY
        );

        $this->closeAmqpConnections($amqp);
    }

    private function getAmqpConnectionAndChannel(): array
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USERNAME'),
            env('RABBITMQ_PASSWORD')
        );

        $channel = $connection->channel();

        return [
            'connection' => $connection,
            'channel' => $channel,
        ];
    }

    private function amqpQueueDeclare($channel, $queue)
    {
        $channel->queue_declare($queue, false, true, false, false);
    }

    private function amqpQueueBind($channel, $queue, $exchange, $bindName)
    {
        $channel->queue_bind($queue, $exchange, $bindName);
    }

    private function closeAmqpConnections($amqp)
    {
        $amqp['channel']->close();
        $amqp['connection']->close();
    }
}
