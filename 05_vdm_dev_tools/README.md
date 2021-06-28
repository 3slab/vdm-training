# Example 05 : VDM dev tools

This example extends the previous one [04 : VDM asynchonous message](../04_vdm_async) to show how to use the different
development tools bundled with VDM.

The important parts of this example are the configuration with the local transport and the `print_msg` configuration.

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage - Example 1

Open 3 terminals. In one, start the compute consumer :

```shell script
make start-dev-consume
```

In another one, run the output consumer.

```shell script
make start-dev-output
``` 

And start the api in the last terminal :

```shell script
make start-dev-api
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the queue, handled by the consumer and dispatched to an output queue.

## Usage - Example 2

Open 1 terminal and consume using the local env

```shell script
make start-local-consume
```

## Cleanup

```shell script
make down
```