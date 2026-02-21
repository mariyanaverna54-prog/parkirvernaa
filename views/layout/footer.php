<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Jam Digital Real-time
function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeString = hours + ':' + minutes + ':' + seconds;
    
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const dayName = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    const dateString = dayName + ', ' + date + ' ' + month + ' ' + year;
    
    const clockEl = document.getElementById('clock');
    const dateEl = document.getElementById('date');
    const clockEl2 = document.getElementById('clock2');
    const dateEl2 = document.getElementById('date2');
    
    if (clockEl) clockEl.textContent = timeString;
    if (dateEl) dateEl.textContent = dateString;
    if (clockEl2) clockEl2.textContent = timeString;
    if (dateEl2) dateEl2.textContent = dateString;
}

// Update setiap detik
if (document.getElementById('clock') || document.getElementById('clock2')) {
    updateClock();
    setInterval(updateClock, 1000);
}

// === NOTIFICATION SYSTEM ===
function goToLaporan(platNomor, notifId) {
    // Mark as read
    let readNotifs = JSON.parse(localStorage.getItem('readNotifications') || '[]');
    if (!readNotifs.includes(notifId)) {
        readNotifs.push(notifId);
        localStorage.setItem('readNotifications', JSON.stringify(readNotifs));
    }
    
    // Simpan plat nomor yang akan di-highlight
    sessionStorage.setItem('highlightPlat', platNomor);
    
    // Redirect ke laporan
    window.location.href = 'index.php?c=Laporan&m=index';
}

function markAsRead(notifId) {
    // Simpan ke localStorage
    let readNotifs = JSON.parse(localStorage.getItem('readNotifications') || '[]');
    if (!readNotifs.includes(notifId)) {
        readNotifs.push(notifId);
        localStorage.setItem('readNotifications', JSON.stringify(readNotifs));
    }
    
    // Update UI
    const notifItem = document.querySelector(`.notif-item[data-id="${notifId}"]`);
    if (notifItem) {
        const indicator = notifItem.querySelector('.unread-indicator');
        if (indicator) {
            indicator.style.display = 'none';
        }
        notifItem.style.opacity = '0.6';
    }
    
    // Update badge count
    updateNotifBadge();
}

function updateNotifBadge() {
    const readNotifs = JSON.parse(localStorage.getItem('readNotifications') || '[]');
    const allNotifs = document.querySelectorAll('.notif-item');
    let unreadCount = 0;
    
    allNotifs.forEach(item => {
        const id = parseInt(item.getAttribute('data-id'));
        if (!readNotifs.includes(id)) {
            unreadCount++;
        } else {
            const indicator = item.querySelector('.unread-indicator');
            if (indicator) indicator.style.display = 'none';
            item.style.opacity = '0.6';
        }
    });
    
    const badge = document.querySelector('.notif-badge');
    if (badge) {
        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
}

// Jalankan saat halaman load
document.addEventListener('DOMContentLoaded', function() {
    updateNotifBadge();
    
    // Clear old notifications (older than 1 day)
    const today = new Date().toDateString();
    const lastClear = localStorage.getItem('lastNotifClear');
    if (lastClear !== today) {
        localStorage.removeItem('readNotifications');
        localStorage.setItem('lastNotifClear', today);
    }
});

// === ANTI-BACK: Cegah back ke halaman setelah logout ===
(function() {
    // Disable back button
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    
    // Cek session setiap 1 detik, jika tidak ada redirect ke login
    setInterval(function() {
        fetch('index.php?c=Auth&m=checkSession')
            .then(response => response.json())
            .then(data => {
                if (!data.loggedIn) {
                    window.location.replace('index.php?c=Auth&m=login');
                }
            })
            .catch(() => {
                // Jika error, asumsikan session habis
                window.location.replace('index.php?c=Auth&m=login');
            });
    }, 3000); // Cek setiap 3 detik
})();
</script>

</body>
</html>