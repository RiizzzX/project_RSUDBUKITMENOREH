// ================================
// RSUD Bukit Menoreh - App Controller
// ================================

class UIController {
  constructor() {
    this.init();
  }

  init() {
    this.setupDateTime();
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
}

// ================================
// Initialize on Document Load
// ================================

document.addEventListener('DOMContentLoaded', () => {
  window.uiController = new UIController();
});
