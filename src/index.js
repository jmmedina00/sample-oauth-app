const google = {
    baseLink: "https://accounts.google.com/o/oauth2/v2/auth?",
    scope: "https://www.googleapis.com/auth/userinfo.email",
    redirectUri: "http://localhost/google.php"
}

const github = {
    baseLink: "https://github.com/login/oauth/authorize?",
    redirectUri: "http://localhost/github.php"
}

const gitlab = {
    baseLink: "https://gitlab.com/oauth/authorize?",
    redirectUri: "http://localhost/gitlab.php"
}

const dropbox = {
    baseLink: "https://www.dropbox.com/oauth2/authorize?",
    redirectUri: "http://localhost/dropbox.php"
}

window.onload = async () => {
    const googleAuth = document.querySelector("#googleAuth");
    const gitHubAuth = document.querySelector("#githubAuth");
    const gitlabAuth = document.querySelector("#gitlabAuth");
    const dropboxAuth = document.querySelector("#dropboxAuth");

    const apiResponse = await fetch("/app_info.php");
    const {
        GOOGLE_CLIENT_ID, GITHUB_CLIENT_ID, GITLAB_CLIENT_ID,
        DROPBOX_CLIENT_ID
    } = await apiResponse.json();

    const googleScope = `scope=${encodeURIComponent(google.scope)}`
    const googleRedirectUri = `redirect_uri=${encodeURIComponent(google.redirectUri)}`;
    const googleClientId = `client_id=${GOOGLE_CLIENT_ID}`;

    const githubClientId = `client_id=${GITHUB_CLIENT_ID}`;
    const githubRedirectUri = `redirect_uri=${encodeURIComponent(github.redirectUri)}`;

    const gitlabClientId = `client_id=${GITLAB_CLIENT_ID}`;
    const gitlabRedirectUri = `redirect_uri=${encodeURIComponent(gitlab.redirectUri)}`;

    const dropboxClientId = `client_id=${DROPBOX_CLIENT_ID}`;
    const dropboxRedirectUri = `redirect_uri=${encodeURIComponent(dropbox.redirectUri)}`;

    googleAuth.setAttribute(
        "href",
        `${google.baseLink}${googleScope}&${googleRedirectUri}&${googleClientId}&response_type=code`
    );
    gitHubAuth.setAttribute(
        "href",
        `${github.baseLink}${githubClientId}&${githubRedirectUri}&scope=user:email`
    );

    gitlabAuth.setAttribute(
        "href",
        `${gitlab.baseLink}${gitlabClientId}&${gitlabRedirectUri}&response_type=code&scope=read_user`
    );

    dropboxAuth.setAttribute(
        "href",
        `${dropbox.baseLink}${dropboxClientId}&${dropboxRedirectUri}&response_type=code&scope=account_info.read`
    );
}