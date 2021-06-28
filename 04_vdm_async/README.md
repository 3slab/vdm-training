# Example 04 : VDM asynchonous message dispatch

This example is based on the `fanout env` in [03 : Messenger asynchonous message in rabbitmq in fanout mode](../03_messenger_rabbitmq_fanout).
It shows that VDM does not change anything on how we code a messenger data flow. This is a wrapper around messenger.

The important part of this example is the way we build the dispatched message which extends the base VDM Message model with 
the payload attribute. Nothing else has changed from the previous example.

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage

Open 3 terminals. In 2 of them, start the 2 consumers :

```shell script
make start-consume1
make start-consume2
```

Look into the rabbitmq admin UI and see the one exchange binded to the 2 queues.

Start the api in the last terminal :

```shell script
make start-api
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the 2 queues and handled by the 2 consumers.

## Cleanup

```shell script
make down
```