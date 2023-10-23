# Cours de devops

## variable d'environnement:

- `PING_LISTEN_PORT` change le port par defaut de l'api

## utilisation TP01:

```bash
git pull https://github.com/prismillon/devops.git
cd devops
cargo run
```

## utilisation TP02:

```bash
git pull https://github.com/prismillon/devops.git
cd devops
docker build . -t <nom_image> -f stage1.Dockerfile
docker run -it --rm -p 8080:8080 <nom_image>
```

ou

```bash
git pull https://github.com/prismillon/devops.git
cd devops
docker build . -t <nom_image> -f stage2.Dockerfile
docker run -it --rm -p 8080:8080 <nom_image>
```