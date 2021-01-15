# Sample OAuth App

Web application developed by Juan Miguel Medina Prieto as a proof of concept of using OAuth for authentication purposes. Accesses the APIs of Google, GitHub, GitLab and Dropbox in order to get information from the user that grants permission to their respective OAuth app. Reddit is also showcased, though it can't really be used in the app's flow as it doesn't provide the user's email.

## Running the application

1. Make sure you have [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/install/) installed.

2. Go to each service's development console and create an application or project (make sure to choose web app for Reddit and OAuth App for GitHub). Follow the required steps in order to get an OAuth client ID and secret, and only toggle the required scopes for each service:

    * Google: `https://www.googleapis.com/auth/userinfo.email` and `https://www.googleapis.com/auth/userinfo.profile`

    * GitHub: `user:read` and `user:email`

    * GitLab: `read_user`

    * Dropbox: `account_info.read`

    * Reddit: `identity`

3. Clone this repository, either with `git clone` or by downloading directly from GitHub.

4. Use the `sample.env` file as a template for an `.env` file. Fill it in with credentials for the database and the client IDs and secrets the service's developer consoles have generated for the apps/projects.

5. Run the Docker Compose stack by typing `docker-compose up -d`

    * If you want to edit code from VSCode but don't have a binary installed, install the `ms-vscode-remote.remote-containers` extension and choose "Remote-Containers: Reopen in Container"
