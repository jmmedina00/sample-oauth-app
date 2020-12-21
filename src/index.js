const google = {
    baseLink: "https://accounts.google.com/o/oauth2/v2/auth?",
    scope: "https://www.googleapis.com/auth/userinfo.email",
    redirectUri: "http://localhost/google.php"
}

const github = {
    baseLink: "https://github.com/login/oauth/authorize?",
    redirectUri: "http://localhost/github.php"
}

window.onload = async () => {
    const googleAuth = document.querySelector("#googleAuth");
    const gitHubAuth = document.querySelector("#githubAuth");

    const apiResponse = await fetch("/app_info.php");
    const {
        GOOGLE_CLIENT_ID, GITHUB_CLIENT_ID
    } = await apiResponse.json();

    const googleScope = `scope=${encodeURIComponent(google.scope)}`
    const googleRedirectUri = `redirect_uri=${encodeURIComponent(google.redirectUri)}`;
    const googleClientId = `client_id=${GOOGLE_CLIENT_ID}`;

    const githubClientId = `client_id=${GITHUB_CLIENT_ID}`;
    const githubRedirectUri = `redirect_uri=${encodeURIComponent(github.redirectUri)}`;

    googleAuth.setAttribute(
        "href",
        `${google.baseLink}${googleScope}&${googleRedirectUri}&${googleClientId}&response_type=code`
    );
    gitHubAuth.setAttribute(
        "href",
        `${github.baseLink}${githubClientId}&${githubRedirectUri}&scope=user:email`
    );
}