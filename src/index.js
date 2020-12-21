const google = {
    baseLink: "https://accounts.google.com/o/oauth2/v2/auth?",
    scope: "https://www.googleapis.com/auth/userinfo.email",
    redirectUri: "http://localhost/google.php"
}

window.onload = async () => {
    const googleAuth = document.querySelector("#googleAuth");
    const apiResponse = await fetch("/app_info.php");
    const { GOOGLE_CLIENT_ID } = await apiResponse.json();

    const scope = `scope=${encodeURIComponent(google.scope)}`
    const redirectUri = `redirect_uri=${encodeURIComponent(google.redirectUri)}`;
    const clientId = `client_id=${GOOGLE_CLIENT_ID}`;
    googleAuth.setAttribute(
        "href",
        `${google.baseLink}${scope}&${redirectUri}&${clientId}&response_type=code`
    );
}