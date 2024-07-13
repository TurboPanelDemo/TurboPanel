docker compose up --build --force-recreate
docker tag turbo-panel:latest bobicloudvision/turbo-panel:latest
docker push bobicloudvision/turbo-panel:latest
