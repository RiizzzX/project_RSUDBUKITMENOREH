/**
 * RSUD Bukit Menoreh - Antrian Display Controller
 * Handles real-time updates for antrian & farmasi displays
 */

class AntrianDisplayController {
    constructor(options = {}) {
        this.options = {
            updateInterval: options.updateInterval || 5000, // 5 seconds
            currentNumberElement: options.currentNumberElement || '#currentNumber',
            queueListElement: options.queueListElement || '#queueList',
            statsElement: options.statsElement || '.stats-grid',
            apiEndpoint: options.apiEndpoint || '/api/antrian',
            ...options
        };
        
        this.init();
    }

    /**
     * Initialize the controller
     */
    init() {
        console.log('AntrianDisplayController initialized');
        
        // Update immediately
        this.updateDisplay();
        
        // Then update every interval
        this.startAutoUpdate();
        
        // Update datetime
        this.updateDateTime();
        setInterval(() => this.updateDateTime(), 1000);
    }

    /**
     * Start auto-update interval
     */
    startAutoUpdate() {
        this.updateInterval = setInterval(() => {
            this.updateDisplay();
        }, this.options.updateInterval);
    }

    /**
     * Stop auto-update interval
     */
    stopAutoUpdate() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
        }
    }

    /**
     * Update entire display
     */
    async updateDisplay() {
        try {
            const response = await fetch(this.options.apiEndpoint + '/list');
            const data = await response.json();
            
            if (data.status === 'success') {
                this.updateCurrentNumber(data.data[0]?.nomor_antrian || 'N/A');
                this.updateQueueList(data.data);
                this.updateStats(data.stats);
            }
        } catch (error) {
            console.error('Error updating display:', error);
        }
    }

    /**
     * Update current queue number display
     */
    updateCurrentNumber(nomor) {
        const element = document.querySelector(this.options.currentNumberElement);
        if (element && element.textContent !== nomor) {
            // Fade out
            element.style.opacity = '0.5';
            
            // Update text
            setTimeout(() => {
                element.textContent = nomor;
                element.style.opacity = '1';
            }, 300);
        }
    }

    /**
     * Update queue list
     */
    updateQueueList(queueData) {
        const listElement = document.querySelector(this.options.queueListElement);
        if (!listElement) return;
        
        // Build HTML
        const html = queueData.map(item => `
            <div class="antrian-item">
                <div class="antrian-item-number">${item.nomor_antrian}</div>
                <div class="antrian-item-info">
                    <div class="antrian-item-name">${item.pasien_nama}</div>
                    <div class="antrian-item-time">${item.jam_daftar}</div>
                    <div class="antrian-item-medicines">${item.jumlah_obat} item obat</div>
                </div>
                <div class="antrian-item-status">
                    <button class="status-btn ${this.getStatusClass(item.status)}">${this.getStatusLabel(item.status)}</button>
                </div>
            </div>
        `).join('');
        
        listElement.innerHTML = html;
    }

    /**
     * Update statistics
     */
    updateStats(stats) {
        const statElements = document.querySelectorAll('.stat-number');
        if (statElements.length >= 2) {
            statElements[0].textContent = stats.menunggu || 0;
            statElements[1].textContent = stats.totalHariIni || 0;
        }
    }

    /**
     * Get status CSS class
     */
    getStatusClass(status) {
        const classMap = {
            'selesai': 'status-completed',
            'sedang_dilayani': 'status-ready',
            'menunggu': 'status-waiting'
        };
        return classMap[status] || 'status-waiting';
    }

    /**
     * Get status label for display
     */
    getStatusLabel(status) {
        const labelMap = {
            'selesai': 'Selesai',
            'sedang_dilayani': 'Sedang Diproses',
            'menunggu': 'Menunggu'
        };
        return labelMap[status] || 'Menunggu';
    }

    /**
     * Update datetime display
     */
    updateDateTime() {
        const element = document.getElementById('currentDateTime');
        if (!element) return;
        
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
        element.textContent = formatted;
    }

    /**
     * Play notification sound (optional)
     */
    playSound() {
        // Uncomment untuk menggunakan
        // const audio = new Audio('/sounds/notification.mp3');
        // audio.play();
    }

    /**
     * Show browser notification (optional)
     */
    showNotification(title, options = {}) {
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification(title, {
                icon: '/img/logo.png',
                ...options
            });
        }
    }
}

/**
 * Initialize untuk Farmasi Display
 */
document.addEventListener('DOMContentLoaded', () => {
    window.farmasiDisplay = new AntrianDisplayController({
        currentNumberElement: '#currentPharmacyNumber',
        queueListElement: '#pharmacyQueueList',
        apiEndpoint: '/api/farmasi'
    });
});

/**
 * Usage Example:
 * 
 * // Untuk halaman antrian
 * const antrianDisplay = new AntrianDisplayController({
 *     updateInterval: 5000,
 *     apiEndpoint: '/api/antrian'
 * });
 * 
 * // Untuk halaman farmasi
 * const farmasiDisplay = new AntrianDisplayController({
 *     updateInterval: 5000,
 *     apiEndpoint: '/api/farmasi'
 * });
 * 
 * // Stop updating jika diperlukan
 * antrianDisplay.stopAutoUpdate();
 * 
 * // Manual update
 * antrianDisplay.updateDisplay();
 */
