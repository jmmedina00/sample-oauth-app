const BASE_REDIRECT = "http://localhost/auth/";

const getCookie = (name) => {
    const regex = new RegExp(`^${name}=(.+)$`);
    
    const allCookies = document.cookie;
    const separated = allCookies.split(";").map(cookieString => cookieString.trim());
    const desiredCookie = separated.find(cookieString => regex.test(cookieString));
    const [_, cookieValue] = desiredCookie.match(regex);
    return cookieValue;
};

const oauthData = {
    google: {
        baseLink: "https://accounts.google.com/o/oauth2/v2/auth?",
        scope: "https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
        responseType: "code"
    },
    github: {
        baseLink: "https://github.com/login/oauth/authorize?",
        scope: "user:read,user:email"
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
        baseLink: "https://www.reddit.com/api/v1/authorize?duration=temporary&",
        scope: "identity",
        responseType: "code"
    }
}

window.onload = async () => {
    const apiResponse = await fetch("/app_info.php");
    const clientIds = await apiResponse.json();

    for (const [service, {baseLink, scope, responseType}] of Object.entries(oauthData)) {
        const cookieName = `${service.toUpperCase()}_STATE`;
        const state = getCookie(cookieName);
        
        const clientId = clientIds[`${service.toUpperCase()}_CLIENT_ID`];
        const authElement = document.querySelector(`#${service}Auth`);

        const scopeString = `scope=${encodeURIComponent(scope)}`;
        const responseTypeString = responseType ? `&response_type=${responseType}` : "";
        const redirectUri = `&redirect_uri=${encodeURIComponent(BASE_REDIRECT + service + ".php")}`;
        const stateString = `&state=${encodeURIComponent(state)}`
        authElement.setAttribute(
            "href",
            `${baseLink}${scopeString}${responseTypeString}${redirectUri}${stateString}&client_id=${clientId}`
        );
    }
}