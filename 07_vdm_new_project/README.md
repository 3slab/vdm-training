# Example 07 : VDM project from scratch

This example is a guide on how to setup a new VDM dataflow project using the official [VDM skeleton](https://github.com/3slab/vdm-skeleton)

The important part of this example is to demonstrate that it is very easy to create a new VDM project from scratch.

## Steps

In this example, we are going to collect data from the "Ile de France" dataset 
"Sites labellisés patrimoine mondial de l'UNESCO en Île-de-France (données Ministère de la culture et de la communication)"
hosted on [OpenDataSoft](https://data.iledefrance.fr/explore/dataset/sites-labellises-patrimoine-mondial-de-lunesco-en-ile-de-france-donnee-minister0/information/)
by its API.

### Clone and cleanup the skeleton project

```shell script
git clone https://github.com/3slab/vdm-skeleton vdm-from-scratch
cd vdm-from-scratch
rm -rf .git
```

**Note : we delete the .git folder because you are most probably going to init and push to another repository**

We replace the `vdm_skeleton` in the files key with something related to the project.

For example :

```shell script
find . -type f  -exec sed -i 's/vdm_skeleton/vdm_from_scratch/g' {} \;
``` 

Create the empty env secret file referenced in the docker-compose (or remove the line from the compose file)

```shell script
echo "" >> .env.secrets
```

### Implement your dataflow

In this example, we are just going to collect and compute in the same handler then use a store handler and an API. So
we won't use the compute node just the collect and store one.

We remove the following files from the cloned skeleton project :

```shell script
rm -rf config/packages/openweathermap*
rm -rf local/*
rm -rf src/Controller/*
rm -rf src/Entity/*
rm -rf src/Executor/*
rm -rf src/Manager/*
rm -rf src/Message/*
rm -rf src/MessageHandler/*
rm -rf src/Repository/*
```

Then the [source](./source) folder contains all the files for this exercice : 

```shell script
cp -rf ./source/* path_to_vdm_from_scratch_project/
```

Edit the `Makefile` :

1. Remove all the command referencing the compute commands

2. Replace `openweathermap` by `opendatasoft` in the remaining command

```shell script
sed -i 's/openweathermap/opendatasoft/g' Makefile
```

And change the content of the `README.md` file to match your project.

### Test your dataflow

Starts the containers :

```shell script
make up
```

Wait for the composer install to end in the API container (launched in the container entrypoint) and setup the db :

```shell script
make setup-db
```

In order to populate the db with data to test the API, you need to run these commands :

```shell script
make dev-collect
make dev-compute
make dev-store
```

The API is available on [http://localhost:5000](http://localhost:5000) and lists the `App\Entity\CulturalSite` entity.