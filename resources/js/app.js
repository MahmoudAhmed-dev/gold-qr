import './bootstrap';
import QRCode from 'qrcode';
import { jsPDF } from "jspdf";

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

const downloadAllBtn = document.getElementById('download-all-pdf-btn');
const selectAllCheckbox = document.getElementById('select-all-bars');

if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.bar-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
}

if (downloadAllBtn) {
    downloadAllBtn.addEventListener('click', async () => {
        const originalText = downloadAllBtn.innerText;
        downloadAllBtn.disabled = true;
        downloadAllBtn.innerText = 'Generating...';

        try {
            let bars = [];
            const selectedCheckboxes = document.querySelectorAll('.bar-checkbox:checked');

            if (selectedCheckboxes.length > 0) {
                // Use selected items
                selectedCheckboxes.forEach(cb => {
                    bars.push({
                        identifier: cb.dataset.identifier,
                        code: cb.dataset.code,
                        serial_number: cb.dataset.serial
                    });
                });
            } else {
                // Fetch all items if nothing selected
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('export', 'json');
                
                const response = await fetch(currentUrl.toString());
                if (!response.ok) throw new Error('Network response was not ok');
                
                bars = await response.json();
            }
            
            const doc = new jsPDF();
            const pageWidth = doc.internal.pageSize.getWidth();
            const margin = 0;
            const colCount = 4;
            const colWidth = (pageWidth - (margin * 2)) / colCount;
            const rowHeight = 20;
            
            let x = margin;
            let y = margin;
            let col = 0;
            
            for (let i = 0; i < bars.length; i++) {
                const bar = bars[i];
                
                // Generate QR
                const canvas = document.createElement('canvas');
                await new Promise((resolve, reject) => {
                    const url = window.location.origin + '/' + document.documentElement.lang + '/bars/' + bar.identifier;
                    QRCode.toCanvas(canvas, url, { width: 100, margin: 1 }, function (error) {
                        if (error) reject(error);
                        else resolve();
                    });
                });
                const qrDataUrl = canvas.toDataURL('image/png');
                
                // Draw border
                doc.setDrawColor(200);
                doc.rect(x, y, colWidth - 2, rowHeight - 2);
                
                // Add QR Image
                doc.addImage(qrDataUrl, 'PNG', x + 2, y + 1, 15, 15);
                
                // Add Text
                doc.setFontSize(10);
                doc.text(bar.code, x + 27, y + 7);
                
                doc.text(bar.serial_number, x + 27, y + 12);
                
                // Move to next position
                col++;
                x += colWidth;
                
                if (col >= colCount) {
                    col = 0;
                    x = margin;
                    y += rowHeight;
                    
                    if (y + rowHeight > doc.internal.pageSize.getHeight() - margin) {
                        doc.addPage();
                        y = margin;
                    }
                }
            }
            
            doc.save('gold-bars-qr.pdf');
            
        } catch (error) {
            console.error('Error generating PDF:', error);
            alert('Failed to generate PDF');
        } finally {
            downloadAllBtn.disabled = false;
            downloadAllBtn.innerText = originalText;
        }
    });
}

