// resources/js/modules/sidebar.js
export function initializeSidebar() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mainWrapper = document.getElementById('mainWrapper');

    if (!sidebarToggle || !mainWrapper) {
        console.warn('Sidebar toggle button or main wrapper not found.');
        return;
    }

    // Function to set the sidebar state
    const setSidebarState = (isOpen) => {
        if (isOpen) {
            document.documentElement.classList.add('sidebar-open');
            document.documentElement.classList.remove('sidebar-closed');
        } else {
            document.documentElement.classList.add('sidebar-closed');
            document.documentElement.classList.remove('sidebar-open');
        }
    };

    // Get the sidebar state from localStorage (default to true)
    let isSidebarOpen = localStorage.getItem('isSidebarOpen') !== 'false'; // Defaults to true

    // Set the initial state based on localStorage
    setSidebarState(isSidebarOpen);

    // Add event listener for toggle
    sidebarToggle.addEventListener('click', () => {
        isSidebarOpen = !isSidebarOpen;

        // Save the new state to localStorage
        localStorage.setItem('isSidebarOpen', isSidebarOpen);

        // Update the sidebar state
        setSidebarState(isSidebarOpen);
    });
}
