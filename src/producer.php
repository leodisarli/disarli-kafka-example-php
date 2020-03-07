<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('127.0.0.1:9092');
$config->setBrokerVersion('1.0.0');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);

$producer = new \Kafka\Producer(
    function() {
        return [
            [
                'topic' => 'test',
                'value' => 'test....message.',
                'key' => 'testkey',
            ],
        ];
    }
);

$producer->success(function($result) {
    var_dump($result);
});
$producer->error(function($errorCode) {
    var_dump($errorCode);
});
$producer->send(true);