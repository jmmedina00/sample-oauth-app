window.onload = async () => {
  const params = (new URL(document.location)).searchParams;
  const userId = params.get("id");

  console.log(userId);
}