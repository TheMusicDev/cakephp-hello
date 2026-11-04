# CakePHP 5 starter for Dokploy

A CakePHP 5.4 hello-world starter that runs on [`themusicdev/php-apache`](https://github.com/TheMusicDev/php-apache) — a framework-agnostic Apache + PHP 8.5 runtime image. This repo is what the Dokploy **CakePHP 5** template deploys (via `ghcr.io/themusicdev/cakephp-hello:latest`).

## How the pieces fit

```
themusicdev/php-apache:8.5.12   → Apache + PHP 8.5 runtime, no app code
        │  + this repo's code (child Dockerfile, built by CI)
        ▼
ghcr.io/themusicdev/cakephp-hello:latest → runtime + hello app = what the template deploys
        │  + your real app code
        ▼
your image (your repo, child Dockerfile) → what you deploy in Dokploy
```

**You never deploy the starter image for a real project.** To build your own app:

1. Fork this repo.
2. Replace the hello app with your code (or re-scaffold with `composer create-project cakephp/app` and keep the useful bits from this repo: `config/app_local.php` env wiring, `Dockerfile`).
3. Create a Dokploy **Application** (Git provider, Dockerfile build) pointing at your fork.
4. Add a MariaDB/MySQL service in the same environment and set `DATABASE_URL` (`mysql://user:pass@db:3306/dbname`) in the app's environment block.

The skeleton only reads **`DATABASE_URL`** for DB config (see `config/app_local.php`) — the legacy `DATABASE_*` env vars are not honored.

## What works out of the box (from the runtime image)

- Apache rewrite, `AllowOverride All`, pretty URLs
- Document root: `/var/www/html/webroot` (CakePHP default)
- Traefik/Dokploy proxy awareness: real client IP via `X-Forwarded-For`, `HTTPS=on` from `X-Forwarded-Proto`
- Extensions: intl, pdo_mysql, mysqli, opcache, zip, gd, bcmath, exif, imagick, soap, xsl, bz2, ftp, pdo_pgsql, pgsql, gmp, mbstring, simplexml, pdo_sqlite (+ base: lexbor, uri, sodium)
- Composer + git + unzip included; `tmp/` and `logs/` made writable by the entrypoint
- `DEBUG=false` default in this image (DebugKit requires dev deps; enable dev locally, not here)

## Local test

```bash
docker compose up -d     # app at :8080, MariaDB included
docker compose down
```
