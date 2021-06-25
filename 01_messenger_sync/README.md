# Example 01 : Messenger Synchronous Dispatch

This example shows how a message dispatched without a routing definition is processed synchronously by messenger.

The important settings of this example :

```yaml
# config/packages/messenger.yaml

framework:
    messenger:
        routing: {}
```

**There is no routing definition for the message `App\Message\SyncActionMessage` dispatched in the `/` route.

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage

```shell script
make start
```

Then go to [http://localhost:5000](http://localhost:5000)

## Cleanup

```shell script
make down
```