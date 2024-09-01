# Prerequisites

This project should be done after successful finish of introduction course: REST API with Symfony 5 and PHP 8 using Domain Driven Design.

Introduction course can be found here: 
```
\\shareserver\Internship\IT\Backend Developer\Courses\REST-API-with-Symfony-5-and-PHP8-using-Domain-Driven-Design
```

# Internship

In this repository you can find minimized version of our DBP (Digital Business Platform) project that can be used for starting internship project. It contains docker compose files along with minimized source code written in PHP.

Sections:
- [Developer Tools](#developer-tools)
- [Services](#services)
- [Project setup](#project-setup)
---
### Developer Tools
#### 1.1 Introduction
This section describes the developer tools used in development of this project. These tools are recommendation and they are not mandatory for use. It is just an overview based on developer experience during development of this project.

#### 1.2 Tools
 - [Visual Studio Code](https://code.visualstudio.com/) 
 - [Git](https://git-scm.com/)
 - [WSL 2 - Windows 10](https://docs.microsoft.com/en-us/windows/wsl/install-win10)
 - [Docker - Docker compose](https://www.docker.com/get-started)
 - [Postman](https://www.postman.com/)

#### 1.3 Visual Studio Code
Visual Studio Code is a free source-code editor made by Microsoft for Windows, Linux and macOS. Features include support for debugging, syntax highlighting, intelligent code completion, snippets, code refactoring, and embedded Git. Main reason why we use Visual Studio Code is because it supports remote development feature. That means that Visual Studio Code allows us to use a container, remote machine, or the Windows Subsystem for Linux (WSL) as a full-featured development environment.

**Recommended Extensions:**

- **General**
	- [GitLens](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens) (Better insight into GIT)
	- [Better Comments](https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments) (Human-friendly comments)
	- [Remote Development Extension pack](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack) (Easier remote development)
- **Backend (PHP)**
	- [PHP DocBlocker](https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker) (Code comments)
	- [PHP Getters & Setters](https://marketplace.visualstudio.com/items?itemName=phproberto.vscode-php-getters-setters) (Fast generator of getters and setters for PHP class properties)
	- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) (PHP code intelligence – IntelliSense, code formatting)
	- [PHP Namespace Resolver](https://marketplace.visualstudio.com/items?itemName=MehediDracula.php-namespace-resolver) (Easier class import)

#### 1.4 Git
Git is a free and open source distributed version control system designed to handle everything from small to very large projects with speed and efficiency.

#### 1.5 WSL 2 – Only on Windows 10
Windows Subsystem for Linux is a compatibility layer for running Linux binary executables natively on Windows 10. WSL 2 introduced important changes such as a real Linux kernel, through a subset of Hyper-V features. In other words this means that almost any Linux distribution can run on Windows 10 without the need of VirutalBox or Vmware.

WSL 2 has even more benefits because it now supports Docker inside. That means that we will run Docker on the Linux machine (natively) where Windows 10 is the host OS.

#### 1.6 Docker – Docker compose
Docker is a set of platform as a service products that use OS-level virtualization to deliver software in packages called containers. Whole project is containerized, so every container is isolated one from another, any changes on host system will not affect Docker containers.

Docker compose is a tool for defining and running multi-container Docker applications. With Compose, you use a YAML file to configure your application’s services. Then, with a single command, you create and start all the services from your configuration.

#### 1.7 Postman

Postman is an API platform for developers to design, build, test and iterate their APIs.

---
### Services

We are using additional services as our application requires in order to be able to work. As we use Docker for development, every service is in exactly one Docker container.

Since every Docker container is running with the provided image, we have specifically built images for every service that our application need. As we know that instructions for building such images are saved in Dockerfile, we are versioning those Dockerfiles in the special Git repository on our internal GitLab server.

Currently we use this services (they are listed in docker-compose.yml):

- [Nginx](https://www.nginx.com/)
- [MariaDB (MySQL)](https://mariadb.org/)
- [Adminer](https://www.adminer.org/)
- [MailCatcher](https://mailcatcher.me/)
- [RabbitMQ](https://www.rabbitmq.com/)
- [LocalStack](https://localstack.cloud/)
- [PHP](https://www.php.net/)

#### 2.1 Nginx
Nginx is a web server that can also be used as a reverse proxy, load balancer, mail proxy and HTTP cache. 
Nginx is used as a starting point in the connection to every other service (Reverse proxy feature).

Primarily used to deliver: 
- PHP backend response
- Static files from LocalStack

Also used to deliver development admin panels:
- Adminer (MySQL UI)
- Mailcatcher web UI
- RabbitMQ web UI

#### 2.2 MariaDB (MySQL)
MariaDB is a community-developed, commercially supported fork of the MySQL relational database management system, intended to remain free and open-source software under the GNU General Public License.

MariaDB is used as the primary data storage for our project.

#### 2.3 Adminer
Adminer is a tool for managing content in MySQL databases. Adminer is distributed under Apache license in a form of a single PHP file.

#### 2.4 MailCatcher
MailCatcher runs a super simple SMTP server which catches any message sent to it and display in a web interface.
MailCatcher is used for Email testing, usually sent from backend.

#### 2.5 RabbitMQ
RabbitMQ is an open-source message-broker software that originally implemented the Advanced Message Queuing Protocol.
RabbitMQ is used for the queue jobs, currently it is responsible for delivering messages from publisher to the consumers.

#### 2.6 LocalStack
LocalStack provides an easy-to-use test/mocking framework for developing Cloud applications. Currently, the focus is primarily on supporting the AWS - Amazon cloud stack.
LocalStack is used to mimic the AWS services (S3, ElasticSearch...) that our application use in a production. With this service we can easily test our app that uses AWS services in local environment.

#### 2.7 PHP
Docker container that contains PHP executable.

---
### Project setup

In order to setup the project on your local machine here are some prerequisites that needs to be fulfilled before we proceed onward.
#### 3.1 Prerequisites

 - WSL 2
	- If you are using Windows 10 for development, then you will need to use and be familiar with WSL 2 (Ubuntu). Development is always better inside Linux environment and WSL 2 (Ubuntu) provides that Linux environment to us.
 - Docker – Docker compose
	- The whole environment and services needed by the project
 - Git
	- So you can do some version control things in development. Ex: git clone, git commit, git push and git pull.
- Postman
    - Used to make API calls to the backend

To install WSL 2, you must be running Windows 10 Pro.

Requirements

- For x64 systems: Version 1903 or higher, with Build 18362 or higher.
- For ARM64 systems: Version 2004 or higher, with Build 19041 or higher.
- Builds lower than 18362 do not support WSL 2. Use the *Windows Update Assistant* to update your version of Windows.

For a full guide head up to [Windows Subsystem for Linux Installation Guide for Windows 10](https://docs.microsoft.com/en-us/windows/wsl/install-win10).

For a full command reference head up to: [WSL 2 command reference](https://docs.microsoft.com/en-us/windows/wsl/reference)

WSL Tips

You can access WSL 2 shell by executing this command in PowerShell: 
```powershell
wsl --distribution <Distro>
```

Example: 
```powershell
wsl --distribution Ubuntu-20.04
```

Always put projects inside WSL 2 Linux filesystem

Linux filesystem in WSL 2 is better in performance than normal Windows filesystem. So it is recommended for use for a rich development experience.

The best place to put code is `~/`  - Home directory of the user inside WSL 2 machine.

You can access WSL 2 Linux filesystem from Windows:
- Navigate to folder you want to open via WSL 2 Linux shell
- Execute command: `explorer.exe .` *(note that fullstop is important)*
- File explorer will be opened in a new window

Always run your code editor inside WSL 2 machine for the best experience.

- Visual Studio Code
	- [Developing in WSL](https://code.visualstudio.com/docs/remote/wsl)
	- [Using Remote Containers in WSL 2](https://code.visualstudio.com/blogs/2020/07/01/containers-wsl)

WSL looses internet connection

If you have problems with network/internet connection on WSL, answer from [stackoverflow](https://stackoverflow.com/a/64057835/1319799) helped. Run following commands from command line as administrator:
```powershell
wsl --shutdown
netsh winsock reset
netsh int ip reset all
netsh winhttp reset proxy
ipconfig /flushdns
netsh winsock reset
shutdown /r
```

Installing Docker Desktop

To install Docker Desktop, you must be running Windows 10 Pro.

Head up to these guides (order is important) 

 1. [Get Started with Docker](https://www.docker.com/get-started)
 2. [Docker Desktop WSL 2 backend](https://docs.docker.com/docker-for-windows/wsl/)


#### 3.2 Project setup

Edit hosts file so you can reach app via browser (Note: you must have Administrator/root privileges)

The location of the hosts file will differ by operating system. The typical locations are noted below:
- Windows 10 
	- `C:\Windows\System32\drivers\etc\hosts`
- Linux 
	- `/etc/hosts`
- Mac OS X 
	- `/private/etc/hosts`

Hosts file content:
```
#vehicle-app
127.0.0.1 	adminer.dev-vehicle.com
127.0.0.1 	mailcatcher.dev-vehicle.com
127.0.0.1   message-broker.dev-vehicle.com
127.0.0.1 	backend.dev-vehicle.com
127.0.0.1   bucket.dev-vehicle.com
#vehicle-app
```
Clone project from our internal GitLab server:

```git
git clone https://gitlab.mikroe.com/dbp/backend-internship.git
```

This action requires user credentials and you should enter credentials that you entered during registration.
```sh
Cloning into 'backend-internship'...
Username for 'https://gitlab.mikroe.com': aleksa.b.jovanovic
Password for 'https://aleksa.b.jovanovic@gitlab.mikroe.com':
remote: Enumerating objects: 487, done.
remote: Counting objects: 100% (487/487), done.
remote: Compressing objects: 100% (296/296), done.
remote: Total 487 (delta 142), reused 487 (delta 142), pack-reused 0
Receiving objects: 100% (487/487), 204.09 KiB | 6.58 MiB/s, done.
Resolving deltas: 100% (142/142), done.
```

Navigate to the cloned project:
```sh
cd backend-internship/
```

Boot up project:
```sh
docker-compose down && docker-compose build --force-rm --no-cache && docker-compose up --force-recreate
```

**Note: This command will lock your terminal.**

This commands starts docker containers. If containers does not exists, it pulls/builds all docker containers needed for project. Allow all file sharing if system asked. You should get message that all containers are up.

You can stop containers from working by pressing CTRL + c in locked terminal.

After stopping, be sure to clear containers:
```sh
docker-compose down
```

In order to start using app, you should initialize DB first. Login via ssh to backend container where the backend app is running:
```sh
docker exec -it backend bash
```
Once we get access to container, we need to run app fixtures that will prefill database with initial data:
```sh
cd /var/www/html && php bin/console doctrine:migrations:migrate && php bin/console doctrine:fixtures:load
```

Answer to all questions with YES

DB credentials are following:
```
server: database
username: root
password: root
```
**Note: you can use these credentials to login into database via Adminer  - http://adminer.dev-vehicle.com**

DB prefill will automatically create admin user for us:
```json
{
	"fullName": "Administrator",
	"username": "admin",
	"password": "admin123",
	"email": "admin@dev-vehicle.com",
	"active": true,
	"avatar": null
}
```

Create S3 bucket for file storage.

```sh
docker exec -it bucket awslocal s3api create-bucket --bucket vehicle-app --region us-west-1
```

Output should be something like this:
```sh
{
    "Location": "http://vehicle-app.s3.localhost.localstack.cloud:4566/"
}
```

Add privileges..

```sh
docker exec -it bucket awslocal s3api put-bucket-acl --bucket vehicle-app --acl public-read
```

Now we can list created bucket to see if it's created.

```sh
docker exec -it bucket awslocal s3 ls
```

Console output:

```
2022-06-30 08:08:42 vehicle-app
```

Import API routes in Postman

File that you will use to import routes into Postman is in the project root, file named: `Identity Acess.postman_collection.json`

Click [here](https://learning.postman.com/docs/getting-started/importing-and-exporting-data/) to learn how to import route collection for Identity Access module.

Login & Access to application API

In order to be able to access to application API, you will need to login. Login functionality works by providing Access token on each API request via HTTP request header ```Authorization: Bearer <access token>```

To retreive access token you can use Postman with previously imported routes:
Identity Access > Auth > Access Token

**Note: As you remember we initialized our app database, that means that we already have user that we can use for login.**

It is POST request with the following body:
```json
{
    "username": "admin",
    "password": "admin123"
}
```
Response:
```
{
    "@context": "/api/contexts/AccessToken",
    "@id": "/api/identity-access/access-tokens/6ab661f1-31a3-4ba8-8796-00b0f9f6899e",
    "@type": "AccessToken",
    "tokenType": "Bearer",
    "expiresIn": "36000",
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9....",
    "refreshToken": null
}
```

**Note: All available API routes can be viewed on http://backend.dev-vehicle.com/api**

Now you are ready to start development of your module, also you can open up urls in browser that we defined previously:

- http://adminer.dev-vehicle.com
- http://mailcatcher.dev-vehicle.com
- http://message-broker.dev-vehicle.com
- http://backend.dev-vehicle.com
