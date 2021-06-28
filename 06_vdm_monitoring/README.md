# Example 06 : VDM Monitoring

This example extends the previous one [05 : VDM dev tools](../05_vdm_dev_tools) to show how the activation of monitoring
does not impact the dataflow code.

The important part of this example is the configuration in `config/packages/vdm_library.yaml`

## Installation

```shell script
make build
```

And wait a few seconds for the composer install command to end.

## Usage

Open 2 terminals. In one, start the compute consumer :

```shell script
make start-dev-consume
``` 

And start the api in the last terminal :

```shell script
make start-dev-api
```

Then go to [http://localhost:5000](http://localhost:5000) to dispatch a message into the bus and see it being send to 
the queue, handled by the consumer and dispatched to an output queue.

Then you can look into [http://localhost:9102/metrics](http://localhost:9102/metrics) to view metrics pushed to the statsd exporter.

## Cleanup

```shell script
make down
```