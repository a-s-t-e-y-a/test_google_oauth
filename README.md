# Project Setup Guide

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

Follow these steps to set up the project:

### 1. Spin docker container

```bash
sudo docker-compose up --build -d
```
### 2. Seed Database Table

```bash
php src/seed.php
```
### 2. Add Credentials for Google Auth

```bash 
go to src/config/client_secret.json
```

### Ports 

### Phpmyadmin
```bash
localhost:8080
```

### Web App

```bash
localhost
```

