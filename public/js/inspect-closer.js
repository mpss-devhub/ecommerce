
  // Disable right-click
  document.addEventListener("contextmenu", function (e) {
    e.preventDefault();
  });

  // Block common DevTools shortcuts
  document.addEventListener("keydown", function (e) {
    if (
      e.key === "F12" ||
      (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === "i") ||
      (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === "j") ||
      (e.ctrlKey && e.key.toLowerCase() === "u")
    ) {
      e.preventDefault();
      alert("Inspect is disabled!");
      return false;
    }
  });

  // Detect DevTools using screen size difference
  setInterval(() => {
    const threshold = 160;
    const isOpen =
      window.outerWidth - window.innerWidth > threshold ||
      window.outerHeight - window.innerHeight > threshold;

    if (isOpen) {
      alert("DevTools is open! Access denied.");
      window.location.href = "about:blank";
    }
  }, 1000);
