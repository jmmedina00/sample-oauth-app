window.onload = async () => {
  const keys = ["name", "email", "accesses"]
  const params = (new URL(document.location)).searchParams;
  const userId = params.get("id");

  const apiResponse = await fetch(`/get_user.php?id=${userId}`);
  const user = await apiResponse.json();

  for (const key of keys) {
    const value = user[key];
    document.querySelector(`#${key}`).innerHTML = value;
  }
}