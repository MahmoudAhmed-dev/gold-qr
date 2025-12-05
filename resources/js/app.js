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

