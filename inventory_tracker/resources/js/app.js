// resources/js/app.js

import './bootstrap'; // Ensure bootstrap.js exists and is correctly set up
import '../css/app.css';

import { initializeSidebar } from './modules/sidebar';
import { initializeModal } from './modules/logout';


document.addEventListener('DOMContentLoaded', () => {
    initializeSidebar();
    initializeModal();
});
