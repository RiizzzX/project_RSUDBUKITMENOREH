// ================================
// RSUD Bukit Menoreh - App Controller
// ================================

class UIController {
  constructor() {
    this.scrollSpeed = 1; // pixels per frame
    this.isScrolling = false;
    this.init();
  }

  init() {
    this.setupDateTime();
    this.setupAutoScroll();
  }

  setupDateTime() {
    this.updateDateTime();
    setInterval(() => this.updateDateTime(), 1000);
  }

  updateDateTime() {
    const now = new Date();
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
    };
    const formatted = now.toLocaleDateString('id-ID', options);
    const element = document.getElementById('currentDateTime');
    if (element) {
      element.textContent = formatted;
    }
  }

  setupAutoScroll() {
    const antrianList = document.getElementById('antrianListContainer');
    if (!antrianList) return;

    let currentScroll = 0;
    const scrollSpeed = 0.8; // pixels per frame - lebih slow
    let isAtBottom = false;

    const performScroll = () => {
      const maxScroll = antrianList.scrollHeight - antrianList.clientHeight;
      
      if (currentScroll >= maxScroll) {
        // Reset to top
        currentScroll = 0;
        antrianList.scrollTop = 0;
      } else {
        currentScroll += scrollSpeed;
        antrianList.scrollTop = currentScroll;
      }

      // Continue scrolling
      requestAnimationFrame(performScroll);
    };

    // Wait a bit before starting scroll for page stability
    setTimeout(() => {
      requestAnimationFrame(performScroll);
    }, 500);
  }
}

// ================================
// Initialize on Document Load
// ================================

document.addEventListener('DOMContentLoaded', () => {
  window.uiController = new UIController();
});
