
  // Detect if running in Safari
  const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
  const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
  let devToolsOpened = false;

  // Block right-click context menu
  document.addEventListener('contextmenu', e => e.preventDefault());

  // Block keyboard shortcuts
  document.addEventListener('keydown', function(e) {
      // Safari/Mac specific shortcuts
      if (isSafari && (
          e.key === 'F12' ||
          (isMac && e.metaKey && e.altKey && (e.key === 'I' || e.key === 'C' || e.key === 'J')) ||
          (!isMac && e.ctrlKey && e.shiftKey && e.key === 'I')
      )) {
          e.preventDefault();
          showWarning();
          return false;
      }
      
      // Universal shortcuts
      if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C'))) {
          e.preventDefault();
          showWarning();
          return false;
      }
  });

  // Detect devtools via window size difference
  function checkDevTools() {
      const threshold = 100;
      const widthDiff = window.outerWidth - window.innerWidth;
      const heightDiff = window.outerHeight - window.innerHeight;
      
      if (widthDiff > threshold || heightDiff > threshold) {
          if (!devToolsOpened) {
              devToolsOpened = true;
              showWarning();
          }
      }
  }

  // Detect devtools via debugger statement
  function checkDebugger() {
      const startTime = performance.now();
      debugger;
      const endTime = performance.now();
      
      if (endTime - startTime > 500) {
          if (!devToolsOpened) {
              devToolsOpened = true;
              showWarning();
          }
      }
  }

  // Show warning message
  function showWarning() {
      const warning = document.getElementById('devtools-warning');
      warning.style.display = 'block';
      
      // Optionally redirect after delay
      // setTimeout(() => { window.location.href = '/'; }, 3000);
  }

  // Run checks periodically
  setInterval(checkDevTools, 1000);
//   setInterval(checkDebugger, 1500);

  // Ensure links work normally
  document.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function(e) {
          if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
              // Allow normal link behavior
              return true;
          }
          // Block attempts to open in new tab if desired
          // e.preventDefault();
          // alert('Opening in new tab is disabled');
      });
  });

  // Additional protection for mobile Safari
  if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
      document.addEventListener('touchstart', function(e) {
          if (e.touches.length > 1) {
              e.preventDefault();
          }
      }, { passive: false });
  }