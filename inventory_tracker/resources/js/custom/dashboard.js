(function() {
    try {
       
        var isSidebarOpen = localStorage.getItem('isSidebarOpen');
        if (isSidebarOpen === null) {
          
            isSidebarOpen = 'true';
        }
        if (isSidebarOpen === 'true') {
            document.documentElement.classList.add('sidebar-open');
        } else {
            document.documentElement.classList.add('sidebar-closed');
        }
    } catch (e) {
        document.documentElement.classList.add('sidebar-open');
    }
})();