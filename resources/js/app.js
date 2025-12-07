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
            const sourceCanvas = container.querySelector('.qrcode-canvas');
            if (sourceCanvas) {
                // Create a new canvas for the composite image
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                
                const padding = 10;
                const textWidth = 200; // Space for text
                
                // Set dimensions
                canvas.width = sourceCanvas.width + (padding * 2) + textWidth;
                canvas.height = sourceCanvas.height + (padding * 2);
                
                // Fill white background
                ctx.fillStyle = '#FFFFFF';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                // Draw QR Code
                ctx.drawImage(sourceCanvas, padding, padding);
                
                // Draw Text
                ctx.fillStyle = '#000000';
                ctx.font = 'bold 22px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                
                const code = btn.dataset.code || '';
                const serial = btn.dataset.serial || '';
                
                const textX = sourceCanvas.width + (padding * 2) + (textWidth / 2);
                const centerY = canvas.height / 2;
                
                ctx.fillText(`${code}`, textX, centerY - 20);
                ctx.fillText(`${serial}`, textX, centerY + 20);
                
                // Download
                const image = canvas.toDataURL("image/png");
                const link = document.createElement('a');
                link.download = (btn.dataset.filename || 'qrcode') + '.png';
                link.href = image;
                link.click();
            }
        }
    }
});

