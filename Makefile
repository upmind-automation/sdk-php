# Makefile for building and running upmind-sdk-php

# Variables
IMAGE_NAME = upmind-sdk-php
CONTAINER_NAME = upmind-sdk-php
MOUNT_DIR = /upmind-sdk-php

.PHONY: all build run stop shell clean

# Default target
setup: build run

# Build the Docker image
build:
	docker build -t $(IMAGE_NAME) .

# Run the Docker container in the background
run:
	docker run -d --name $(CONTAINER_NAME) -v $(PWD):$(MOUNT_DIR) $(IMAGE_NAME)

# Stop the Docker container
stop:
	docker stop $(CONTAINER_NAME)

# Get a shell into the running Docker container
shell:
	docker exec -it $(CONTAINER_NAME) /bin/bash

# Run phpstan
static-analysis:
	docker exec -it $(CONTAINER_NAME) ./vendor/bin/phpstan analyse --memory-limit=1G

# Clean target
clean:
	docker rm -f $(CONTAINER_NAME)
	docker rmi $(IMAGE_NAME)