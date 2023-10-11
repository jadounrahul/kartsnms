# Docker

An official KartsNMS docker image based on Alpine Linux and Nginx is available
on [DockerHub](https://hub.docker.com/r/kartsnms/kartsnms/).

# Documentation

Full install and configuration documentation can be found on the [GitHub repository](https://github.com/kartsnms/docker).

# Quick install
1. Install docker: https://docs.docker.com/engine/install/
2. Download and unzip composer files:
```
mkdir kartsnms
cd kartsnms
wget https://github.com/kartsnms/docker/archive/refs/heads/master.zip
unzip master.zip
cd docker-master/examples/compose
```
3. Set a new mysql password in .env and inspect docker-composer.yml
4. Bring up the docker containers
```
docker compose up -d
```
5. Open webui to finish configuration. `http://localhost` (use the correct ip or name instead of localhost)
