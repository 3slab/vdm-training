# Example 02 : Messenger Asynchronous Dispatch

This example shows how a message dispatched with a correct routing definition is processed asynchronously by messenger
when running `messenger:consume`.

The important settings of this example :

```yaml
# config/packages/messenger.yaml

framework:
    messenger:
        async:
            dsn: "MESSENGER_DSN"

        routing:
            App\Message\AsyncActionMessage: [async, async2]

```

**When the message is dispatched it is sent to the async transport. When the message is consumed, the handler is executed.**

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage - Exercice 1

Open 3 terminals. In 2 of them, start the 2 consumers :

```shell script
make start-async-consume1
make start-async-consume2
```

Look into the rabbitmq admin UI and see the 2 exchanges and the 2 queues that have been created and binded together.

Start the api in the last terminal :

```shell script
make start-api
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the 2 queues and handled by the 2 consumers.

## Usage - Exercice 2

Open 3 terminals. In 2 of them, start the 2 consumers :

```shell script
make start-fanout-consume1
make start-fanout-consume2
```

Look into the rabbitmq admin UI and see the one exchange binded to the 2 queues.

Start the api in the last terminal :

```shell script
make start-fanout-api
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the 2 queues and handled by the 2 consumers.

## Usage - Exercice 3

Open 3 terminals. First setup the kafka topic :

```shell script
make exec-kafka-create-topic
```

And starts the API :

```shell script
make start-kafka-api
```

In the last 2 terminals, starts the 2 consumers :

```shell script
make start-kafka-consume1
make start-kafka-consume2
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the topic and consumed by the 2 consumers (with different kafka group id).

## Cleanup

```shell script
make down
```