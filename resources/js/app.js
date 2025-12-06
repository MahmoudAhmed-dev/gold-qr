import './bootstrap';
import QRCode from 'qrcode';

const canvas = document.getElementById('qrcode');

if (canvas) {
    QRCode.toCanvas(canvas, window.location.href, function (error) {
        if (error) console.error(error);
    });
}

const canvases = document.querySelectorAll('.qrcode-canvas');
canvases.forEach(canvas => {
    const url = canvas.getAttribute('data-url');
    if (url) {
        QRCode.toCanvas(canvas, url, function (error) {
            if (error) console.error(error);
        });
    }
});

document.addEventListener('click', function(e) {
    const btn = e.target.closest('.download-qr-btn');
    if (btn) {
        const container = btn.closest('.bg-surface'); 
        
        if (container) {
            const canvas = container.querySelector('.qrcode-canvas');
            if (canvas) {
                const image = canvas.toDataURL("image/png");
                const link = document.createElement('a');
                link.download = (btn.dataset.filename || 'qrcode') + '.png';
                link.href = image;
                link.click();
            }
        }
    }
});

