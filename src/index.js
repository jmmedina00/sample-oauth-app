const BASE_REDIRECT = "http://localhost/"

const oauthData = {
    google: {
        baseLink: "https://accounts.google.com/o/oauth2/v2/auth?",
        scope: "https://www.googleapis.com/auth/userinfo.email",
        responseType: "code"
    },
    github: {
        baseLink: "https://github.com/login/oauth/authorize?",
        scope: "user:email"
    },
    gitlab: {
        baseLink: "https://gitlab.com/oauth/authorize?",
        scope: "read_user",
        responseType: "code"
    },
    dropbox: {
        baseLink: "https://www.dropbox.com/oauth2/authorize?",
        scope: "account_info.read",
        responseType: "code"
    },
    reddit: {
        baseLink: "https://www.reddit.com/api/v1/authorize?duration=temporary&state=lipsum&",
        scope: "identity",
        responseType: "code"
    }
}

window.onload = async () => {
    const apiResponse = await fetch("/app_info.php");
    const clientIds = await apiResponse.json();

    for (const [service, {baseLink, scope, responseType}] of Object.entries(oauthData)) {
        const clientId = clientIds[`${service.toUpperCase()}_CLIENT_ID`];
        const authElement = document.querySelector(`#${service}Auth`);

        const scopeString = `scope=${encodeURIComponent(scope)}`;
        const responseTypeString = responseType ? `&response_type=${responseType}` : "";
        const redirectUri = `&redirect_uri=${encodeURIComponent(BASE_REDIRECT + service + ".php")}`;
        authElement.setAttribute(
            "href",
            `${baseLink}${scopeString}${responseTypeString}${redirectUri}&client_id=${clientId}`
        );
    }
}