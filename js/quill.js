// Quill
import './formats/boldBlot.js';
import './formats/italicBlot.js';
import './formats/underlineBlot.js';
import './formats/linkBlot.js';

const onClick = (selector, format) => {
    document.querySelector(selector).addEventListener('click', () => {
        const currentFormat = quill.getFormat(); // Get current formatting
        quill.format(format, !currentFormat[format]); // Toggle format
    });
};

onClick('#bold-button', 'bold');
onClick('#italic-button', 'italic');
onClick('#underline-button', 'underline');

document.querySelector('#link-button').addEventListener('click', () => {
    const value = prompt('Enter link URL');
    quill.format('link', value || false); // Remove link if value is empty
});

const quill = new Quill('#editor', {
    formats: ['bold', 'italic', 'underline', 'link'],
});
