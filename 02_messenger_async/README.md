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
            App\Message\AsyncActionMessage: async

```

**When the message is dispatched it is sent to the async transport. When the message is consumed, the handler is executed.**

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage

Open 2 terminals.

Start the api in one :

```shell script
make start-api
```

Start the consumer in another one :

```shell script
make start-consume
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being handled in the consumer.

## Cleanup

```shell script
make down
```