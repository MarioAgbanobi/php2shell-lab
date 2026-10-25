# php2shell-lab

A minimal, intentionally outdated PHP login/signup app for **local, authorized
testing only**. Built as a target environment for demonstrating detection and
mitigation of CVE-2026-109618 / CVE-2026-109619 ("php2shell").

This repository contains **no exploit code**. It's a plain PHP app (login,
signup, SQLite storage, password hashing) running on a pre-patch PHP version
via Docker, for use alongside separate, clearly-labeled PoC/scanning tools.

## ⚠️ Scope

- Intended to run on `127.0.0.1` only (see `docker-compose.yml`).
- Never expose this container to the public internet.
- Use only against your own local Docker instance.

## Setup

```bash
docker compose up -d
docker ps
```

Then open `http://127.0.0.1:8080` in your browser.

## Mitigation reference

Patched PHP releases: 8.2.35, 8.3.36, 8.4.27, 8.5.12+.
See the official advisory: https://www.php.net/archive/2026.php#2026-10-21-5

## Stop the lab

```bash
docker compose down
```